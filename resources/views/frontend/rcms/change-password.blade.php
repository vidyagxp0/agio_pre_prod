
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Vidyagxp - Software</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/nlsiabbt295w89cjmcocv6qjdg3k7ozef0q9meowv2nkwyd3/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('user/css/virtual-select.min.css') }}">
    <script src="{{ asset('user/js/virtual-select.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('user/css/rcms_style.css') }}">

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/stock.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" integrity="sha512-F8mgNaoH6SSws+tuDTveIu+hx6JkVcuLqTQ/S/KJaHJjGc8eUxIrBawMnasq2FDlfo7FYsD8buQXVwD+0upbcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bottom-links {
            display: flex;
            align-items: center;
            margin-top: 15px;
            margin-left: 10px;
            position: relative;
        }

        .bottom-links div {
            height: 35px;
            margin-right: 15px;
            display: grid;
            place-items: center;
        }

        .bottom-links a {
            color: black;
            width: 100%;
            display: grid;
            place-items: center;
            height: 100%;
            transition: all 0.3s linear;
            text-decoration: none;
        }

        .bottom-links a:hover {
            color: #4274da;
            text-decoration: none;
        }

        .bottom-links .notification {
            position: absolute;
            right: 0;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h4>Change Password</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('change.password') }}">
                @csrf

                <!-- Current Password -->
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" 
                           name="current_password" 
                           class="form-control @error('current_password') is-invalid @enderror"
                           placeholder="Enter current password">

                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password"  id="new_password"
                           name="new_password" 
                           class="form-control @error('new_password') is-invalid @enderror"
                           placeholder="Enter new password">

                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password"   id="confirm_password"
                           name="new_password_confirmation" 
                           class="form-control"
                           placeholder="Confirm new password">
                </div>

                <!-- Password Rules -->
                <div class="mb-3">
                    <small class="text-muted">
                        Password must be 7–20 characters, include uppercase, lowercase, number, and special character.
                    </small>
                </div>
                <button type="button" onclick="togglePassword('new_password')">Show New Password</button>
                <button type="button" onclick="toggleConfirmPassword('confirm_password')">Show Confrim Password</button>
                <button type="submit" class="btn btn-primary w-100 mt-2">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(id) {
    let input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}
function toggleConfirmPassword(id) {
    let input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}
</script>

</body>
</html>

