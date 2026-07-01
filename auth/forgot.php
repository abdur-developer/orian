<div class="form-group">
    <input type="hidden" name="forgot" value="1">
    <label for="number">মোবাইল নাম্বার </label>
    <input type="number" name="number" id="number" placeholder="নাম্বার প্রবেশ করান" required>
</div>

<button type="submit" class="submit-btn">ওটিপি পাঠান</button>

<div class="signup-link">
    <?php
        $ref = isset($_GET['refer']) ? htmlspecialchars($_GET['refer']) : '';
        echo 'পাসওয়ার্ড মনে আছে ? <a href="index.php?refer=' . urlencode($ref) . '">লগইন করুন</a>'; 
    ?>
</div>