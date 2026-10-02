<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;

class Dashboard extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
    return redirect()->to(base_url('login'));
}

        $keyword = $this->request->getGet('search');
        $status  = $this->request->getGet('status');
        $type    = $this->request->getGet('type');

        $perPage = 10;

        $query = $this->customerModel;

if ($keyword) {
    $query->groupStart()
        ->like('account_number', $keyword)
        ->orLike('customer_name', $keyword)
        ->orLike('email', $keyword)
        ->orLike('phone', $keyword)
        ->groupEnd();
}

if ($status) {
    $query->where('status', $status);
}

if ($type) {
    $query->where('connection_type', $type);
}

$accounts = $query
    ->orderBy('created_at', 'DESC')
    ->paginate($perPage);

        $data = [
            'accounts'           => $accounts,
            'pager'              => $this->customerModel->pager,
            'total_accounts'     => $this->customerModel->getTotalAccounts(),
            'active_accounts'    => $this->customerModel->getCountByStatus('active'),
            'inactive_accounts'  => $this->customerModel->getCountByStatus('inactive'),
            'suspended_accounts' => $this->customerModel->getCountByStatus('suspended'),
            'current_page'       => $this->request->getGet('page') ?? 1,
            'search_keyword'     => $keyword,
            'filter_status'      => $status,
            'filter_type'        => $type,
        ];

        return view('home/index', $data);

        
    }

    public function view($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    $account = $this->customerModel->find($id);

    if (!$account) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Customer account not found.'
        );
    }

    $data = [
        'account' => $account
    ];

    return view('home/view_account', $data);
}

public function create()
{
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    return view('home/create_account');
}

public function store()
{
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    $rules = [
        'account_number'  => 'required|max_length[50]|is_unique[customer_accounts.account_number]',
        'customer_name'   => 'required|max_length[150]',
        'address'         => 'required',
        'phone'           => 'permit_empty|max_length[20]',
        'email'           => 'permit_empty|valid_email|max_length[100]',
        'meter_number'    => 'permit_empty|max_length[50]',
        'connection_type' => 'required|in_list[residential,commercial,industrial]',
        'status'          => 'required|in_list[active,inactive,suspended]',
    ];

    if (!$this->validate($rules)) {
        return redirect()
            ->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $data = [
        'account_number'  => $this->request->getPost('account_number'),
        'customer_name'   => $this->request->getPost('customer_name'),
        'address'         => $this->request->getPost('address'),
        'phone'           => $this->request->getPost('phone'),
        'email'           => $this->request->getPost('email'),
        'meter_number'    => $this->request->getPost('meter_number'),
        'connection_type' => $this->request->getPost('connection_type'),
        'status'          => $this->request->getPost('status'),
    ];

    $this->customerModel->insert($data);

    return redirect()
        ->to(base_url('dashboard'))
        ->with('success', 'Customer account added successfully.');
}

public function edit($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    $account = $this->customerModel->find($id);

    if (!$account) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Customer account not found.'
        );
    }

    $data = [
        'account' => $account
    ];

    return view('home/edit_account', $data);
}

public function update($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    $account = $this->customerModel->find($id);

    if (!$account) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Customer account not found.'
        );
    }

    $rules = [
        'account_number'  => "required|max_length[50]|is_unique[customer_accounts.account_number,id,{$id}]",
        'customer_name'   => 'required|max_length[150]',
        'address'         => 'required',
        'phone'           => 'permit_empty|max_length[20]',
        'email'           => 'permit_empty|valid_email|max_length[100]',
        'meter_number'    => 'permit_empty|max_length[50]',
        'connection_type' => 'required|in_list[residential,commercial,industrial]',
        'status'          => 'required|in_list[active,inactive,suspended]',
    ];

    if (!$this->validate($rules)) {
        return redirect()
            ->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $data = [
        'account_number'  => $this->request->getPost('account_number'),
        'customer_name'   => $this->request->getPost('customer_name'),
        'address'         => $this->request->getPost('address'),
        'phone'           => $this->request->getPost('phone'),
        'email'           => $this->request->getPost('email'),
        'meter_number'    => $this->request->getPost('meter_number'),
        'connection_type' => $this->request->getPost('connection_type'),
        'status'          => $this->request->getPost('status'),
    ];

    $this->customerModel->update($id, $data);

    return redirect()
        ->to(base_url('dashboard'))
        ->with('success', 'Customer account updated successfully.');
}

public function delete($id)
{
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    $account = $this->customerModel->find($id);

    if (!$account) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Customer account not found.'
        );
    }

    $this->customerModel->delete($id);

    return redirect()
        ->to(base_url('dashboard'))
        ->with('success', 'Customer account deleted successfully.');
}
}