<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

   <form method="POST" action="{{ route('login') }}" class="user">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter Email Address...">
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user" name="password" required placeholder="Password">
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck">
                <label class="custom-control-label" for="customCheck">Remember Me</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Login
        </button>
    </form>
</x-guest-layout>
