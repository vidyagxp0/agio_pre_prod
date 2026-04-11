
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
