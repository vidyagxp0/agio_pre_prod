<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="container">
    <div class="login-container col-md-6">
        <div class="logo" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 65px;">
            <img src="{{ asset('user/images/agio-removebg-preview.png') }}" alt="Agio Logo" style="filter: none; transform: scale(0.7); max-width: 100px; margin-bottom: 14px; ">
            <img src="{{ asset('user/images/vidhyaGxp.png') }}" alt="Vidhya GxP Logo" style="filter: none; transform: scale(1.8); max-width: 100px; margin-right: 65px;">

        </div>
        
        <h2 class="text-center">Employee Login</h2>
        {{-- @if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif --}}
<form method="POST" action="{{ route('employee.login.submit') }}">
    @csrf
    <div class="form-group mb-3">
        <label for="full_employee_id">Employee Code</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control custom-border" id="full_employee_id" name="full_employee_id" placeholder="Enter your code" value="{{ old('full_employee_id') }}" required>
        </div>
    </div>
    
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <div class="input-group">
            <span class="input-group-text" style="height: 46px;"><i class="fas fa-lock"></i></span>
            <input type="password" class="form-control custom-border" id="password" name="password" placeholder="Enter your password" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>

    </div>
</div>

    <style>
        .container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
    .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            /* border: 2px solid black; */
            box-shadow: 0 9px 15px rgb(18 5 23 / 60%);
            width: 100%;
            max-width: 500px; 
        }

     
        h2 {
            font-size: 30px;
            font-weight: bold;
            color: #182848;
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            font-size: 16px;
            font-weight: 500;
            color: #182848;
        }

        
        input[type="email"], input[type="password"] {
            font-size: 16px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #317bf2;
            outline: none;
            box-shadow: 0 0 5px rgba(75, 108, 183, 0.5);
        }

        
        .btn-primary {
            background-color: #317bf2;
            border-color: #317bf2;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            border-radius: 4px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #317bf2;
        }

        
        .alert-danger {
            font-size: 14px;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }
   
</style>
