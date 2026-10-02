<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Customer Account - Puihaha Electric</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 0;
        }

        .main-container {
            background: white;
            max-width: 900px;
            margin: auto;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-section h1 {
            color: #667eea;
            font-weight: bold;
        }

        .form-section {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            overflow: hidden;
        }

        .form-header {
            background: #0d6efd;
            color: white;
            padding: 14px 20px;
        }

        .form-body {
            padding: 25px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.15);
        }

        .btn-update {
            background: #f59e0b;
            color: white;
            border: none;
        }

        .btn-update:hover {
            background: #d97706;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="main-container">

        <div class="header-section">
            <h1>
                <i class="bi bi-lightning-charge-fill text-warning"></i>
                Puihaha Electric Company
            </h1>

            <p class="text-muted mb-0">
                Edit Customer Account
            </p>
        </div>

        <div class="mb-4">
            <a
                href="<?= base_url('dashboard') ?>"
                class="btn btn-secondary"
            >
                <i class="bi bi-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>

            <div class="alert alert-danger">

                <strong>Please check the following:</strong>

                <ul class="mb-0 mt-2">

                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>

        <div class="form-section">

            <div class="form-header">
                <h4 class="mb-0">
                    <i class="bi bi-pencil-square"></i>
                    Edit Account Information
                </h4>
            </div>

            <div class="form-body">

                <form
                    action="<?= base_url('dashboard/update/' . $account['id']) ?>"
                    method="POST"
                >

                    <?= csrf_field() ?>

                    <div class="row g-3">

                        <!-- Account Number -->
                        <div class="col-md-6">

                            <label
                                for="account_number"
                                class="form-label"
                            >
                                Account Number
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="account_number"
                                name="account_number"
                                value="<?= esc(old('account_number', $account['account_number'])) ?>"
                                required
                            >

                        </div>

                        <!-- Customer Name -->
                        <div class="col-md-6">

                            <label
                                for="customer_name"
                                class="form-label"
                            >
                                Customer Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="customer_name"
                                name="customer_name"
                                value="<?= esc(old('customer_name', $account['customer_name'])) ?>"
                                required
                            >

                        </div>

                        <!-- Address -->
                        <div class="col-12">

                            <label
                                for="address"
                                class="form-label"
                            >
                                Address
                            </label>

                            <textarea
                                class="form-control"
                                id="address"
                                name="address"
                                rows="3"
                                required
                            ><?= esc(old('address', $account['address'])) ?></textarea>

                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">

                            <label
                                for="phone"
                                class="form-label"
                            >
                                Phone
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                name="phone"
                                value="<?= esc(old('phone', $account['phone'])) ?>"
                            >

                        </div>

                        <!-- Email -->
                        <div class="col-md-6">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="<?= esc(old('email', $account['email'])) ?>"
                            >

                        </div>

                        <!-- Meter Number -->
                        <div class="col-md-6">

                            <label
                                for="meter_number"
                                class="form-label"
                            >
                                Meter Number
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="meter_number"
                                name="meter_number"
                                value="<?= esc(old('meter_number', $account['meter_number'])) ?>"
                            >

                        </div>

                        <!-- Connection Type -->
                        <div class="col-md-6">

                            <label
                                for="connection_type"
                                class="form-label"
                            >
                                Connection Type
                            </label>

                            <?php
                            $connectionType = old(
                                'connection_type',
                                $account['connection_type']
                            );
                            ?>

                            <select
                                class="form-select"
                                id="connection_type"
                                name="connection_type"
                                required
                            >

                                <option
                                    value="residential"
                                    <?= $connectionType === 'residential' ? 'selected' : '' ?>
                                >
                                    Residential
                                </option>

                                <option
                                    value="commercial"
                                    <?= $connectionType === 'commercial' ? 'selected' : '' ?>
                                >
                                    Commercial
                                </option>

                                <option
                                    value="industrial"
                                    <?= $connectionType === 'industrial' ? 'selected' : '' ?>
                                >
                                    Industrial
                                </option>

                            </select>

                        </div>

                        <!-- Status -->
                        <div class="col-md-6">

                            <label
                                for="status"
                                class="form-label"
                            >
                                Status
                            </label>

                            <?php
                            $status = old(
                                'status',
                                $account['status']
                            );
                            ?>

                            <select
                                class="form-select"
                                id="status"
                                name="status"
                                required
                            >

                                <option
                                    value="active"
                                    <?= $status === 'active' ? 'selected' : '' ?>
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    <?= $status === 'inactive' ? 'selected' : '' ?>
                                >
                                    Inactive
                                </option>

                                <option
                                    value="suspended"
                                    <?= $status === 'suspended' ? 'selected' : '' ?>
                                >
                                    Suspended
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a
                            href="<?= base_url('dashboard') ?>"
                            class="btn btn-outline-secondary"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-update px-4"
                        >
                            <i class="bi bi-check-circle"></i>
                            Update Account
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>