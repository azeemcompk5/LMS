<?php

namespace App\Controllers;

class Transport extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $totalDrivers = $db->table('transport_drivers')
            ->countAllResults();

        $totalVehicles = $db->table('transport_vehicles')
            ->countAllResults();

        $totalRoutes = $db->table('transport_routes')
            ->countAllResults();

        $totalAssignments = $db->table('transport_student_assignments')
            ->countAllResults();

        return view('transport/index', [
            'totalDrivers'     => $totalDrivers,
            'totalVehicles'    => $totalVehicles,
            'totalRoutes'      => $totalRoutes,
            'totalAssignments' => $totalAssignments,
        ]);
    }
    public function drivers()
{
    $db = \Config\Database::connect();

    $drivers = $db->table('transport_drivers')
        ->orderBy('id', 'DESC')
        ->get()
        ->getResult();

    return view('transport/drivers/index', [
        'drivers' => $drivers
    ]);
}
public function createDriver()
{
    return view('transport/drivers/create');
}
public function storeDriver()
{
    $db = \Config\Database::connect();

    $name = trim((string) $this->request->getPost('name'));
    $status = $this->request->getPost('status');

    if ($name === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Driver name is required.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        $status = 'active';
    }

    $db->table('transport_drivers')->insert([
        'name'           => $name,
        'phone'          => trim((string) $this->request->getPost('phone')) ?: null,
        'license_number' => trim((string) $this->request->getPost('license_number')) ?: null,
        'address'        => trim((string) $this->request->getPost('address')) ?: null,
        'status'         => $status,
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/transport/drivers')
        ->with('success', 'Driver added successfully.');
}
public function editDriver($id)
{
    $db = \Config\Database::connect();

    $driver = $db->table('transport_drivers')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$driver) {
        return redirect()->to('/transport/drivers')
            ->with('error', 'Driver not found.');
    }

        return view('transport/drivers/edit', [
        'driver' => $driver
    ]);
    }
    public function updateDriver($id)
{
    $db = \Config\Database::connect();

    $driver = $db->table('transport_drivers')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$driver) {
        return redirect()->to('/transport/drivers')
            ->with('error', 'Driver not found.');
    }

    $name = trim((string) $this->request->getPost('name'));
    $status = $this->request->getPost('status');

    if ($name === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Driver name is required.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        $status = 'active';
    }

    $db->table('transport_drivers')
        ->where('id', $id)
        ->update([
            'name'           => $name,
            'phone'          => trim((string) $this->request->getPost('phone')) ?: null,
            'license_number' => trim((string) $this->request->getPost('license_number')) ?: null,
            'address'        => trim((string) $this->request->getPost('address')) ?: null,
            'status'         => $status,
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/transport/drivers')
        ->with('success', 'Driver updated successfully.');
}
public function deleteDriver($id)
{
    $db = \Config\Database::connect();

    $driver = $db->table('transport_drivers')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$driver) {
        return redirect()->to('/transport/drivers')
            ->with('error', 'Driver not found.');
    }

    $db->table('transport_drivers')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/transport/drivers')
        ->with('success', 'Driver deleted successfully.');
}
public function vehicles()
{
    $db = \Config\Database::connect();

    $vehicles = $db->table('transport_vehicles')
        ->select('transport_vehicles.*, transport_drivers.name AS driver_name')
        ->join(
            'transport_drivers',
            'transport_drivers.id = transport_vehicles.driver_id',
            'left'
        )
        ->orderBy('transport_vehicles.id', 'DESC')
        ->get()
        ->getResult();

    return view('transport/vehicles/index', [
        'vehicles' => $vehicles
    ]);
}
public function createVehicle()
{
    $db = \Config\Database::connect();

    $drivers = $db->table('transport_drivers')
        ->where('status', 'active')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResult();

    return view('transport/vehicles/create', [
        'drivers' => $drivers
    ]);
}
public function storeVehicle()
{
    $db = \Config\Database::connect();

    $vehicleName = trim((string) $this->request->getPost('vehicle_name'));
    $vehicleNumber = strtoupper(trim((string) $this->request->getPost('vehicle_number')));
    $vehicleType = $this->request->getPost('vehicle_type');
    $capacity = $this->request->getPost('capacity');
    $driverId = $this->request->getPost('driver_id');
    $status = $this->request->getPost('status');

    if (
        $vehicleName === '' ||
        $vehicleNumber === '' ||
        !is_numeric($capacity) ||
        (int) $capacity < 1
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter valid vehicle details.');
    }

    if (!in_array($vehicleType, ['bus', 'van', 'car', 'other'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid vehicle type.');
    }

    if (!in_array($status, ['active', 'inactive', 'maintenance'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid vehicle status.');
    }

    // Check duplicate registration number
    $existing = $db->table('transport_vehicles')
        ->where('vehicle_number', $vehicleNumber)
        ->get()
        ->getRow();

    if ($existing) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This vehicle registration number already exists.');
    }

    // Validate selected driver
    if ($driverId !== null && $driverId !== '') {
        $driver = $db->table('transport_drivers')
            ->where('id', $driverId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (!$driver) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid active driver.');
        }
    } else {
        $driverId = null;
    }

    $db->table('transport_vehicles')->insert([
        'vehicle_name'   => $vehicleName,
        'vehicle_number' => $vehicleNumber,
        'vehicle_type'   => $vehicleType,
        'capacity'       => (int) $capacity,
        'driver_id'      => $driverId,
        'status'         => $status,
        'notes'          => trim((string) $this->request->getPost('notes')) ?: null,
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/transport/vehicles')
        ->with('success', 'Vehicle added successfully.');
}
public function editVehicle($id)
{
    $db = \Config\Database::connect();

    $vehicle = $db->table('transport_vehicles')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$vehicle) {
        return redirect()->to('/transport/vehicles')
            ->with('error', 'Vehicle not found.');
    }

    $drivers = $db->table('transport_drivers')
        ->where('status', 'active')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResult();

    return view('transport/vehicles/edit', [
        'vehicle' => $vehicle,
        'drivers' => $drivers
    ]);
}
public function updateVehicle($id)
{
    $db = \Config\Database::connect();

    $vehicle = $db->table('transport_vehicles')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$vehicle) {
        return redirect()->to('/transport/vehicles')
            ->with('error', 'Vehicle not found.');
    }

    $vehicleName = trim((string) $this->request->getPost('vehicle_name'));
    $vehicleNumber = strtoupper(trim((string) $this->request->getPost('vehicle_number')));
    $vehicleType = $this->request->getPost('vehicle_type');
    $capacity = $this->request->getPost('capacity');
    $driverId = $this->request->getPost('driver_id');
    $status = $this->request->getPost('status');

    if (
        $vehicleName === '' ||
        $vehicleNumber === '' ||
        !is_numeric($capacity) ||
        (int) $capacity < 1 ||
        (int) $capacity > 65535
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter valid vehicle details.');
    }

    if (!in_array($vehicleType, ['bus', 'van', 'car', 'other'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid vehicle type.');
    }

    if (!in_array($status, ['active', 'inactive', 'maintenance'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid vehicle status.');
    }

    $duplicate = $db->table('transport_vehicles')
        ->where('vehicle_number', $vehicleNumber)
        ->where('id !=', $id)
        ->get()
        ->getRow();

    if ($duplicate) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This registration number already exists.');
    }

    if ($driverId !== null && $driverId !== '') {
        $driver = $db->table('transport_drivers')
            ->where('id', $driverId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (!$driver) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid active driver.');
        }
    } else {
        $driverId = null;
    }

    $db->table('transport_vehicles')
        ->where('id', $id)
        ->update([
            'vehicle_name'   => $vehicleName,
            'vehicle_number' => $vehicleNumber,
            'vehicle_type'   => $vehicleType,
            'capacity'       => (int) $capacity,
            'driver_id'      => $driverId,
            'status'         => $status,
            'notes'          => trim((string) $this->request->getPost('notes')) ?: null,
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/transport/vehicles')
        ->with('success', 'Vehicle updated successfully.');
}
public function deleteVehicle($id)
{
    $db = \Config\Database::connect();

    $vehicle = $db->table('transport_vehicles')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$vehicle) {
        return redirect()->to('/transport/vehicles')
            ->with('error', 'Vehicle not found.');
    }

    $assignments = $db->table('transport_student_assignments')
        ->where('vehicle_id', $id)
        ->countAllResults();

    if ($assignments > 0) {
        return redirect()->to('/transport/vehicles')
            ->with('error', 'This vehicle is assigned to students. Unassign them before deleting.');
    }

    $db->table('transport_vehicles')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/transport/vehicles')
        ->with('success', 'Vehicle deleted successfully.');
}
public function routes()
{
    $db = \Config\Database::connect();

    $routes = $db->table('transport_routes')
        ->orderBy('id', 'DESC')
        ->get()
        ->getResult();

    return view('transport/routes/index', [
        'routes' => $routes
    ]);
}
public function createRoute()
{
    return view('transport/routes/create');
}
public function storeRoute()
{
    $db = \Config\Database::connect();

    $routeName = trim((string) $this->request->getPost('route_name'));
    $monthlyFee = $this->request->getPost('monthly_fee');
    $status = $this->request->getPost('status');
    $description = trim((string) $this->request->getPost('description'));

    if (
        $routeName === '' ||
        !is_numeric($monthlyFee) ||
        (float) $monthlyFee < 0 ||
        (float) $monthlyFee > 99999999.99
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter a valid route name and monthly fee.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid route status.');
    }

    $db->table('transport_routes')->insert([
        'route_name'  => $routeName,
        'description' => $description !== '' ? $description : null,
        'monthly_fee' => (float) $monthlyFee,
        'status'      => $status,
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/transport/routes')
        ->with('success', 'Transport route added successfully.');
}
public function editRoute($id)
{
    $db = \Config\Database::connect();

    $route = $db->table('transport_routes')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$route) {
        return redirect()->to('/transport/routes')
            ->with('error', 'Transport route not found.');
    }

    return view('transport/routes/edit', [
        'route' => $route
    ]);
}
public function updateRoute($id)
{
    $db = \Config\Database::connect();

    $route = $db->table('transport_routes')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$route) {
        return redirect()->to('/transport/routes')
            ->with('error', 'Transport route not found.');
    }

    $routeName = trim((string) $this->request->getPost('route_name'));
    $monthlyFee = $this->request->getPost('monthly_fee');
    $status = $this->request->getPost('status');
    $description = trim((string) $this->request->getPost('description'));

    if (
        $routeName === '' ||
        !is_numeric($monthlyFee) ||
        (float) $monthlyFee < 0 ||
        (float) $monthlyFee > 99999999.99
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter a valid route name and monthly fee.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid route status.');
    }

    $db->table('transport_routes')
        ->where('id', $id)
        ->update([
            'route_name'  => $routeName,
            'monthly_fee' => (float) $monthlyFee,
            'status'      => $status,
            'description' => $description !== '' ? $description : null,
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/transport/routes')
        ->with('success', 'Transport route updated successfully.');
}
public function deleteRoute($id)
{
    $db = \Config\Database::connect();

    $route = $db->table('transport_routes')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$route) {
        return redirect()->to('/transport/routes')
            ->with('error', 'Transport route not found.');
    }

    $assignments = $db->table('transport_student_assignments')
        ->where('route_id', $id)
        ->countAllResults();

    if ($assignments > 0) {
        return redirect()->to('/transport/routes')
            ->with('error', 'This route is assigned to students. Unassign them before deleting.');
    }

    $db->table('transport_routes')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/transport/routes')
        ->with('success', 'Transport route deleted successfully.');
}
public function stops()
{
    $db = \Config\Database::connect();

    $stops = $db->table('transport_route_stops')
        ->select('transport_route_stops.*, transport_routes.route_name')
        ->join(
            'transport_routes',
            'transport_routes.id = transport_route_stops.route_id',
            'left'
        )
        ->orderBy('transport_route_stops.route_id', 'ASC')
        ->orderBy('transport_route_stops.stop_sequence', 'ASC')
        ->get()
        ->getResult();

    return view('transport/stops/index', [
        'stops' => $stops
    ]);
}
public function createStop()
{
    $db = \Config\Database::connect();

    $routes = $db->table('transport_routes')
        ->where('status', 'active')
        ->orderBy('route_name', 'ASC')
        ->get()
        ->getResult();

    return view('transport/stops/create', [
        'routes' => $routes
    ]);
}
public function storeStop()
{
    $db = \Config\Database::connect();

    $routeId = $this->request->getPost('route_id');
    $stopName = trim((string) $this->request->getPost('stop_name'));
    $stopAddress = trim((string) $this->request->getPost('stop_address'));
    $stopType = $this->request->getPost('stop_type');
    $stopSequence = $this->request->getPost('stop_sequence');
    $pickupTime = trim((string) $this->request->getPost('pickup_time'));
    $dropoffTime = trim((string) $this->request->getPost('dropoff_time'));
    $status = $this->request->getPost('status');

    if (
        !is_numeric($routeId) ||
        (int) $routeId < 1 ||
        $stopName === '' ||
        !is_numeric($stopSequence) ||
        (int) $stopSequence < 1 ||
        (int) $stopSequence > 65535
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter valid stop details.');
    }

    if (!in_array($stopType, ['pickup', 'dropoff', 'both'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid stop type.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid stop status.');
    }

    // Confirm that the selected route exists and is active.
    $route = $db->table('transport_routes')
        ->where('id', (int) $routeId)
        ->where('status', 'active')
        ->get()
        ->getRow();

    if (!$route) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid active route.');
    }

    // Ensure that the stop order is unique within this route.
    $existingStop = $db->table('transport_route_stops')
        ->where('route_id', (int) $routeId)
        ->where('stop_sequence', (int) $stopSequence)
        ->get()
        ->getRow();

    if ($existingStop) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This stop order is already used on this route.');
    }

    // Validate optional times using the 24-hour format.
    foreach ([$pickupTime, $dropoffTime] as $time) {
        if (
            $time !== '' &&
            !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $time)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter valid pickup and drop-off times.');
        }
    }

    $db->table('transport_route_stops')->insert([
        'route_id'      => (int) $routeId,
        'stop_name'     => $stopName,
        'stop_address'  => $stopAddress !== '' ? $stopAddress : null,
        'stop_type'     => $stopType,
        'stop_sequence' => (int) $stopSequence,
        'pickup_time'   => $pickupTime !== '' ? $pickupTime . ':00' : null,
        'dropoff_time'  => $dropoffTime !== '' ? $dropoffTime . ':00' : null,
        'status'        => $status,
        'created_at'    => date('Y-m-d H:i:s'),
        'updated_at'    => date('Y-m-d H:i:s'),
    ]);

        return redirect()->to('/transport/stops')
        ->with('success', 'Transport stop added successfully.');
    }
    public function editStop($id)
{
    $db = \Config\Database::connect();

    $stop = $db->table('transport_route_stops')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$stop) {
        return redirect()->to('/transport/stops')
            ->with('error', 'Stop not found.');
    }

    $routes = $db->table('transport_routes')
        ->orderBy('route_name', 'ASC')
        ->get()
        ->getResult();

    return view('transport/stops/edit', [
        'stop'   => $stop,
        'routes' => $routes
    ]);
}
public function updateStop($id)
{
    $db = \Config\Database::connect();

    $stop = $db->table('transport_route_stops')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$stop) {
        return redirect()->to('/transport/stops')
            ->with('error', 'Stop not found.');
    }

    $routeId = $this->request->getPost('route_id');
    $stopName = trim((string) $this->request->getPost('stop_name'));
    $stopAddress = trim((string) $this->request->getPost('stop_address'));
    $stopType = $this->request->getPost('stop_type');
    $stopSequence = $this->request->getPost('stop_sequence');
    $pickupTime = trim((string) $this->request->getPost('pickup_time'));
    $dropoffTime = trim((string) $this->request->getPost('dropoff_time'));
    $status = $this->request->getPost('status');

    if (
        !is_numeric($routeId) ||
        (int) $routeId < 1 ||
        $stopName === '' ||
        !is_numeric($stopSequence) ||
        (int) $stopSequence < 1 ||
        (int) $stopSequence > 65535
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter valid stop details.');
    }

    if (!in_array($stopType, ['pickup', 'dropoff', 'both'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid stop type.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid stop status.');
    }

    $route = $db->table('transport_routes')
        ->where('id', (int) $routeId)
        ->get()
        ->getRow();

    if (!$route) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Selected route does not exist.');
    }

    // Check duplicate stop order within the selected route.
    $duplicate = $db->table('transport_route_stops')
        ->where('route_id', (int) $routeId)
        ->where('stop_sequence', (int) $stopSequence)
        ->where('id !=', $id)
        ->get()
        ->getRow();

    if ($duplicate) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This stop order is already used on this route.');
    }

    // Validate optional times in 24-hour format.
    foreach ([$pickupTime, $dropoffTime] as $time) {
        if (
            $time !== '' &&
            !preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $time)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please enter valid pickup and drop-off times.');
        }
    }

    $db->table('transport_route_stops')
        ->where('id', $id)
        ->update([
            'route_id'      => (int) $routeId,
            'stop_name'     => $stopName,
            'stop_address'  => $stopAddress !== '' ? $stopAddress : null,
            'stop_type'     => $stopType,
            'stop_sequence' => (int) $stopSequence,
            'pickup_time'   => $pickupTime !== '' ? $pickupTime . ':00' : null,
            'dropoff_time'  => $dropoffTime !== '' ? $dropoffTime . ':00' : null,
            'status'        => $status,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/transport/stops')
        ->with('success', 'Transport stop updated successfully.');
}
public function deleteStop($id)
{
    $db = \Config\Database::connect();

    $stop = $db->table('transport_route_stops')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$stop) {
        return redirect()->to('/transport/stops')
            ->with('error', 'Stop not found.');
    }

    // Do not delete a stop that is assigned to students.
    $assignments = $db->table('transport_student_assignments')
        ->groupStart()
            ->where('pickup_stop_id', $id)
            ->orWhere('dropoff_stop_id', $id)
        ->groupEnd()
        ->countAllResults();

    if ($assignments > 0) {
        return redirect()->to('/transport/stops')
            ->with('error', 'This stop is assigned to students. Reassign the students before deleting.');
    }

    $db->table('transport_route_stops')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/transport/stops')
        ->with('success', 'Transport stop deleted successfully.');
}
public function assignments()
{
    $db = \Config\Database::connect();

    $assignments = $db->table('transport_student_assignments')
        ->select("
            transport_student_assignments.*,
            students.admission_no,
            students.first_name,
            students.last_name,
            transport_routes.route_name,
            transport_vehicles.vehicle_name,
            transport_vehicles.vehicle_number,
            pickup.stop_name AS pickup_stop_name,
            dropoff.stop_name AS dropoff_stop_name
        ")
        ->join(
            'students',
            'students.id = transport_student_assignments.student_id'
        )
        ->join(
            'transport_routes',
            'transport_routes.id = transport_student_assignments.route_id'
        )
        ->join(
            'transport_vehicles',
            'transport_vehicles.id = transport_student_assignments.vehicle_id',
            'left'
        )
        ->join(
            'transport_route_stops AS pickup',
            'pickup.id = transport_student_assignments.pickup_stop_id',
            'left'
        )
        ->join(
            'transport_route_stops AS dropoff',
            'dropoff.id = transport_student_assignments.dropoff_stop_id',
            'left'
        )
        ->orderBy('transport_student_assignments.id', 'DESC')
        ->get()
        ->getResult();

    return view('transport/assignments/index', [
        'assignments' => $assignments
    ]);
}
public function createAssignment()
{
    $db = \Config\Database::connect();

    $students = $db->table('students')
        ->orderBy('first_name', 'ASC')
        ->get()
        ->getResult();

    $routes = $db->table('transport_routes')
        ->where('status', 'active')
        ->orderBy('route_name', 'ASC')
        ->get()
        ->getResult();

    $vehicles = $db->table('transport_vehicles')
        ->where('status', 'active')
        ->orderBy('vehicle_name', 'ASC')
        ->get()
        ->getResult();

    $stops = $db->table('transport_route_stops')
        ->where('status', 'active')
        ->orderBy('route_id', 'ASC')
        ->orderBy('stop_sequence', 'ASC')
        ->get()
        ->getResult();

    return view('transport/assignments/create', [
        'students' => $students,
        'routes'   => $routes,
        'vehicles' => $vehicles,
        'stops'    => $stops,
    ]);
}
public function storeAssignment()
{
    $db = \Config\Database::connect();

    $studentId = $this->request->getPost('student_id');
    $routeId = $this->request->getPost('route_id');
    $vehicleId = $this->request->getPost('vehicle_id');
    $pickupStopId = $this->request->getPost('pickup_stop_id');
    $dropoffStopId = $this->request->getPost('dropoff_stop_id');

    $monthlyFee = $this->request->getPost('monthly_fee');
    $startDate = $this->request->getPost('start_date');
    $endDate = $this->request->getPost('end_date');
    $status = $this->request->getPost('status');
    $notes = trim((string) $this->request->getPost('notes'));

    // Validate required fields.
    foreach ([$studentId, $routeId] as $requiredId) {
        if (
            !is_scalar($requiredId) ||
            !ctype_digit((string) $requiredId) ||
            (int) $requiredId < 1
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid student and route.');
        }
    }

    if (
        !is_numeric($monthlyFee) ||
        (float) $monthlyFee < 0 ||
        (float) $monthlyFee > 99999999.99
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter a valid monthly transport fee.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid assignment status.');
    }

    // Validate optional dates.
    $validDate = function ($date) {
        if ($date === null || $date === '') {
            return true;
        }

        if (!is_string($date)) {
            return false;
        }

        $parsed = \DateTime::createFromFormat('!Y-m-d', $date);

        return $parsed && $parsed->format('Y-m-d') === $date;
    };

    if (!$validDate($startDate) || !$validDate($endDate)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter valid assignment dates.');
    }

    if (
        !empty($startDate) &&
        !empty($endDate) &&
        $endDate < $startDate
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'End date cannot be before start date.');
    }

    // Check student exists.
    $student = $db->table('students')
        ->where('id', (int) $studentId)
        ->get()
        ->getRow();

    if (!$student) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Selected student was not found.');
    }

    // Check route exists and is active.
    $route = $db->table('transport_routes')
        ->where('id', (int) $routeId)
        ->where('status', 'active')
        ->get()
        ->getRow();

    if (!$route) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select an active transport route.');
    }

    // Prevent multiple active assignments for one student.
    if ($status === 'active') {
        $existing = $db->table('transport_student_assignments')
            ->where('student_id', (int) $studentId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This student already has an active transport assignment.');
        }
    }

    // Validate the optional vehicle.
    if ($vehicleId !== null && $vehicleId !== '') {
        if (
            !ctype_digit((string) $vehicleId) ||
            (int) $vehicleId < 1
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid vehicle.');
        }

        $vehicle = $db->table('transport_vehicles')
            ->where('id', (int) $vehicleId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (!$vehicle) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select an active vehicle.');
        }

        $vehicleId = (int) $vehicleId;
    } else {
        $vehicleId = null;
    }

    // Validate pickup stop belongs to the selected route.
    if ($pickupStopId !== null && $pickupStopId !== '') {
        if (
            !ctype_digit((string) $pickupStopId) ||
            (int) $pickupStopId < 1
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid pickup stop.');
        }

        $pickupStop = $db->table('transport_route_stops')
            ->where('id', (int) $pickupStopId)
            ->where('route_id', (int) $routeId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (
            !$pickupStop ||
            !in_array($pickupStop->stop_type, ['pickup', 'both'], true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The selected pickup stop is not valid for this route.');
        }

        $pickupStopId = (int) $pickupStopId;
    } else {
        $pickupStopId = null;
    }

    // Validate drop-off stop belongs to the selected route.
    if ($dropoffStopId !== null && $dropoffStopId !== '') {
        if (
            !ctype_digit((string) $dropoffStopId) ||
            (int) $dropoffStopId < 1
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid drop-off stop.');
        }

        $dropoffStop = $db->table('transport_route_stops')
            ->where('id', (int) $dropoffStopId)
            ->where('route_id', (int) $routeId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (
            !$dropoffStop ||
            !in_array($dropoffStop->stop_type, ['dropoff', 'both'], true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The selected drop-off stop is not valid for this route.');
        }

        $dropoffStopId = (int) $dropoffStopId;
    } else {
        $dropoffStopId = null;
    }

    // Save the assignment.
    $db->table('transport_student_assignments')->insert([
        'student_id'     => (int) $studentId,
        'route_id'       => (int) $routeId,
        'vehicle_id'     => $vehicleId,
        'pickup_stop_id' => $pickupStopId,
        'dropoff_stop_id'=> $dropoffStopId,
        'monthly_fee'    => (float) $monthlyFee,
        'start_date'     => $startDate ?: null,
        'end_date'       => $endDate ?: null,
        'status'         => $status,
        'notes'          => $notes !== '' ? $notes : null,
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s'),
    ]);

    return redirect()->to('/transport/assignments')
        ->with('success', 'Student transport assignment saved successfully.');
}
public function editAssignment($id)
{
    $db = \Config\Database::connect();

    $assignment = $db->table('transport_student_assignments')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$assignment) {
        return redirect()->to('/transport/assignments')
            ->with('error', 'Transport assignment not found.');
    }

    $students = $db->table('students')
        ->orderBy('first_name', 'ASC')
        ->get()
        ->getResult();

    $routes = $db->table('transport_routes')
        ->orderBy('route_name', 'ASC')
        ->get()
        ->getResult();

    $vehicles = $db->table('transport_vehicles')
        ->orderBy('vehicle_name', 'ASC')
        ->get()
        ->getResult();

    $stops = $db->table('transport_route_stops')
        ->orderBy('route_id', 'ASC')
        ->orderBy('stop_sequence', 'ASC')
        ->get()
        ->getResult();

    return view('transport/assignments/edit', [
        'assignment' => $assignment,
        'students'   => $students,
        'routes'     => $routes,
        'vehicles'   => $vehicles,
        'stops'      => $stops,
    ]);
}
public function updateAssignment($id)
{
    $db = \Config\Database::connect();

    $assignment = $db->table('transport_student_assignments')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$assignment) {
        return redirect()->to('/transport/assignments')
            ->with('error', 'Transport assignment not found.');
    }

    $studentId = $this->request->getPost('student_id');
    $routeId = $this->request->getPost('route_id');
    $vehicleId = $this->request->getPost('vehicle_id');
    $pickupStopId = $this->request->getPost('pickup_stop_id');
    $dropoffStopId = $this->request->getPost('dropoff_stop_id');
    $monthlyFee = $this->request->getPost('monthly_fee');
    $startDate = $this->request->getPost('start_date');
    $endDate = $this->request->getPost('end_date');
    $status = $this->request->getPost('status');
    $notes = trim((string) $this->request->getPost('notes'));

    if (
        !is_scalar($studentId) ||
        !ctype_digit((string) $studentId) ||
        (int) $studentId < 1 ||
        !is_scalar($routeId) ||
        !ctype_digit((string) $routeId) ||
        (int) $routeId < 1
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid student and route.');
    }

    if (
        !is_numeric($monthlyFee) ||
        (float) $monthlyFee < 0 ||
        (float) $monthlyFee > 99999999.99
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter a valid monthly fee.');
    }

    if (!in_array($status, ['active', 'inactive'], true)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select a valid assignment status.');
    }

    // Validate dates.
    $validDate = function ($date) {
        if ($date === null || $date === '') {
            return true;
        }

        if (!is_string($date)) {
            return false;
        }

        $parsed = \DateTime::createFromFormat('!Y-m-d', $date);

        return $parsed && $parsed->format('Y-m-d') === $date;
    };

    if (
        !$validDate($startDate) ||
        !$validDate($endDate) ||
        (
            !empty($startDate) &&
            !empty($endDate) &&
            $endDate < $startDate
        )
    ) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please enter valid assignment dates.');
    }

    // Confirm that the student exists.
    $student = $db->table('students')
        ->where('id', (int) $studentId)
        ->get()
        ->getRow();

    if (!$student) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Selected student was not found.');
    }

    // Confirm that the route is active.
    $route = $db->table('transport_routes')
        ->where('id', (int) $routeId)
        ->where('status', 'active')
        ->get()
        ->getRow();

    if (!$route) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please select an active route.');
    }

    // Prevent another active assignment for the same student.
    if ($status === 'active') {
        $existing = $db->table('transport_student_assignments')
            ->where('student_id', (int) $studentId)
            ->where('status', 'active')
            ->where('id !=', $id)
            ->get()
            ->getRow();

        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This student already has another active transport assignment.');
        }
    }

    // Validate the optional vehicle.
    if ($vehicleId !== null && $vehicleId !== '') {
        if (
            !is_scalar($vehicleId) ||
            !ctype_digit((string) $vehicleId) ||
            (int) $vehicleId < 1
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid vehicle.');
        }

        $vehicle = $db->table('transport_vehicles')
            ->where('id', (int) $vehicleId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (!$vehicle) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select an active vehicle.');
        }

        $vehicleId = (int) $vehicleId;
    } else {
        $vehicleId = null;
    }

    // Validate the optional pickup stop.
    if ($pickupStopId !== null && $pickupStopId !== '') {
        if (
            !is_scalar($pickupStopId) ||
            !ctype_digit((string) $pickupStopId) ||
            (int) $pickupStopId < 1
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid pickup stop.');
        }

        $pickupStop = $db->table('transport_route_stops')
            ->where('id', (int) $pickupStopId)
            ->where('route_id', (int) $routeId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (
            !$pickupStop ||
            !in_array($pickupStop->stop_type, ['pickup', 'both'], true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid pickup stop for this route.');
        }

        $pickupStopId = (int) $pickupStopId;
    } else {
        $pickupStopId = null;
    }

    // Validate the optional drop-off stop.
    if ($dropoffStopId !== null && $dropoffStopId !== '') {
        if (
            !is_scalar($dropoffStopId) ||
            !ctype_digit((string) $dropoffStopId) ||
            (int) $dropoffStopId < 1
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid drop-off stop.');
        }

        $dropoffStop = $db->table('transport_route_stops')
            ->where('id', (int) $dropoffStopId)
            ->where('route_id', (int) $routeId)
            ->where('status', 'active')
            ->get()
            ->getRow();

        if (
            !$dropoffStop ||
            !in_array($dropoffStop->stop_type, ['dropoff', 'both'], true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a valid drop-off stop for this route.');
        }

        $dropoffStopId = (int) $dropoffStopId;
    } else {
        $dropoffStopId = null;
    }

    // Update the assignment.
    $db->table('transport_student_assignments')
        ->where('id', $id)
        ->update([
            'student_id'      => (int) $studentId,
            'route_id'        => (int) $routeId,
            'vehicle_id'      => $vehicleId,
            'pickup_stop_id'  => $pickupStopId,
            'dropoff_stop_id' => $dropoffStopId,
            'monthly_fee'     => (float) $monthlyFee,
            'start_date'      => $startDate ?: null,
            'end_date'        => $endDate ?: null,
            'status'          => $status,
            'notes'           => $notes !== '' ? $notes : null,
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

    return redirect()->to('/transport/assignments')
        ->with('success', 'Student transport assignment updated successfully.');
}
public function deleteAssignment($id)
{
    $db = \Config\Database::connect();

    $assignment = $db->table('transport_student_assignments')
        ->where('id', $id)
        ->get()
        ->getRow();

    if (!$assignment) {
        return redirect()->to('/transport/assignments')
            ->with('error', 'Transport assignment not found.');
    }

    $db->table('transport_student_assignments')
        ->where('id', $id)
        ->delete();

    return redirect()->to('/transport/assignments')
        ->with('success', 'Student transport assignment deleted successfully.');
}
}