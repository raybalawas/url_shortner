<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #efefef;
        }

        .container {
            width: 95%;
            margin: auto;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            border-bottom: 2px solid orange;
            background: white;
        }

        .logo-box {
            border: 1px solid orange;
            padding: 4px 8px;
            color: orange;
            margin-right: 10px;
        }

        .logo-text {
            font-weight: bold;
        }

        .right-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .logout-btn {
            border: none;
            background: none;
            cursor: pointer;
        }

        .card {
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
        }

        .card {
            padding: 40px;
            background: #f4f4f4;
            border: 3px solid #222;
            margin-top: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .left-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .left-section h3 {
            color: #1976d2;
            font-size: 38px;
            margin: 0;
        }

        .btn-generate {
            background: #7ec3ff;
            border: 3px solid #1976d2;
            color: #1976d2;
            text-decoration: none;
            padding: 10px 25px;
            font-weight: bold;
        }

        .right-section {
            text-align: center;
        }

        .filter-label {
            display: block;
            color: #ff3333;
            margin-bottom: 10px;
        }

        .options-row {
            display: flex;
            gap: 10px;
        }

        .options-row select {
            padding: 10px;
            border: 3px solid #1976d2;
        }

        .btn-download {
            background: #7ec3ff;
            border: 3px solid #1976d2;
            color: #1976d2;
            font-weight: bold;
            padding: 10px 20px;
            cursor: pointer;
        }

        .url-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .url-table th,
        .url-table td {
            border: 2px solid #999;
            padding: 25px;
            text-align: center;
        }

        .url-table th {
            color: #888;
        }

        .pagination-box {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-btn {
            background: #7ec3ff;
            border: 3px solid #1976d2;
            color: #1976d2;
            padding: 8px 20px;
            margin-left: 10px;
        }


        .page-heading {
            color: #1f6dc1;
            font-size: 36px;
            margin-bottom: 30px;
        }

        .url-box {
            border: 3px solid #222;
            padding: 35px;
            background: #f7f7f7;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 12px;
        }

        .form-input {
            width: 100%;
            padding: 18px;
            font-size: 20px;
            border: 3px solid #222;
            box-sizing: border-box;
        }

        .btn-generate {
            background: #9fd1ff;
            border: 3px solid #1f6dc1;
            color: #1f6dc1;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 50px;
            cursor: pointer;
        }

        .btn-generate:hover {
            opacity: 0.9;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border: 1px solid #c3e6cb;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .card {
            background: #d9d9d9;
            border: 4px solid #222;
            padding: 40px;
        }

        .left-section h3 {
            color: #1565c0;
            font-size: 48px;
            margin-bottom: 40px;
        }

        .invite-row {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 40px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .form-group label {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .form-input {
            height: 70px;
            border: 4px solid #222;
            font-size: 22px;
            padding: 0 20px;
            background: #eee;
        }

        select.form-input {
            cursor: pointer;
        }

        .btn-generate {
            background: #8ec5f4;
            border: 4px solid #1976d2;
            color: #1565c0;
            font-size: 28px;
            padding: 15px 50px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-generate:hover {
            opacity: .9;
        }

        .error-box {
            background: #ffe5e5;
            border: 1px solid red;
            color: red;
            padding: 10px;
            margin-bottom: 15px;
        }

        .text-danger {
            color: red;
            font-size: 14px;
            display: block;
            margin-top: 5px;
        }
    </style>


</head>

<body>

    @include('layout.header')
    <div class="container">
        @yield('content')
    </div>
</body>

</html>