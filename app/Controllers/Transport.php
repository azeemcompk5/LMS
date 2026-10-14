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
}