<style>
    .form-group input {
        width: 100%;
        padding: 1rem;
        border: 2px solid var(--gray-light);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--white);
    }
    .form-group input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-group label {
        font-size: 0.8rem;
        color: var(--primary);
    }
</style>
<div class="form-group">
    <label for="password">পাসওয়ার্ড</label>
    <input type="text" name="new_password" id="password" placeholder="পাসওয়ার্ড প্রবেশ করান" minlength="6" required>
</div>
<input type="hidden" name="number" value="<?php echo htmlspecialchars($number); ?>">
<button type="submit" class="submit-btn">Reset Password</button>
<script>
    // window.addEventListener('beforeunload', function(e) {
    //     if (!confirm("Do you really want to leave?")) {
    //         e.preventDefault();
    //         return false;
    //     }
    // });
</script>