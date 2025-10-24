<div class="form-group">
    <label for="number">মোবাইল নাম্বার </label>
    <input type="number" name="number" id="number" placeholder="নাম্বার প্রবেশ করান" required>
</div>
<input type="hidden" name="refer" value="<?= isset($_GET['refer']) ? htmlspecialchars($_GET['refer']) : 'null'; ?>">
<div class="form-group">
    <label for="password">পাসওয়ার্ড</label>
    <input type="text" name="password" id="password" placeholder="পাসওয়ার্ড প্রবেশ করান" required>
</div>

<div class="form-options">
    <!-- <div class="remember-me"></div> -->
    <div class="forgot-password">
        <a href="?forgot">পাসওয়ার্ড ভুলে গেছেন?</a>
    </div>
</div>

<button type="submit" class="submit-btn">প্রবেশ</button>

<div class="signup-link">
    <?php
        $ref = isset($_GET['refer']) ? htmlspecialchars($_GET['refer']) : '';
        echo 'কোন আকাউন্ট নেই ? <a href="index.php?signup&refer=' . urlencode($ref) . '">রেজিস্টার করুন</a>';
    ?>
</div>