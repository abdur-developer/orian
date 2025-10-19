<!-- <style>
    .checkbox-label {
        display: block;
        margin-bottom: 12px;
        font-weight: 500;
        color: var(--gray-dark);
    }

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .checkbox-option {
        display: flex;
        align-items: center;
        position: relative;
        padding-left: 40px;
        cursor: pointer;
        font-size: 15px;
        user-select: none;
        color: #000 !important;
    }

    .checkbox-option input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color:#898989;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .checkbox-option:hover input ~ .checkmark {
        background-color: #000000;
    }

    .checkbox-option input:checked ~ .checkmark {
        background-color: var(--primary);
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .checkbox-option input:checked ~ .checkmark:after {
        display: block;
    }

    .checkbox-option .checkmark:after {
        left: 7px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .checkbox-group {
            flex-direction: column;
            gap: 10px;
        }
    }
</style> -->

<div class="form-group">
    <input type="hidden" name="signup" value="1">
    <label for="name">সম্পূর্ণ নাম</label>
    <input type="text" name="name" id="name" placeholder="নাম প্রবেশ করান" maxlength="100" required>
</div>
    
<div class="form-group">
    <label for="number">মোবাইল নাম্বার <span>(হোয়াটসঅ্যাপ সুপারিশ)</span></label>
    <input type="number" name="number" id="number" placeholder="নাম্বার প্রবেশ করান" required>
</div>
<div class="form-group">
    <label for="email">ইমেইল অ্যাড্রেস</label>
    <input type="email" name="email" id="email" placeholder="ইমেইল প্রবেশ করান" required>
</div>
<!-- Check Box -->
<!-- <div class="form-group">
    <label class="checkbox-label">আপনি কোন বাহিনীর প্রস্তুতি নিতে ইচ্ছুক ?</label>
    <div class="checkbox-group">
        <div class="col-6">
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="Army">
                <span class="checkmark"></span> বাংলাদেশ সেনাবাহিনী
            </label>
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="Air">
                <span class="checkmark"></span> বাংলাদেশ বিমানবাহিনী
            </label>
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="Navy">
                <span class="checkmark"></span> বাংলাদেশ নৌবাহিনী
            </label>
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="BGB">
                <span class="checkmark"></span> বাংলাদেশ বর্ডারগার্ড
            </label>
        </div>
        <div class="col-6">
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="Police">
                <span class="checkmark"></span> বাংলাদেশ পুলিশ
            </label>
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="Ansar">
                <span class="checkmark"></span> বাংলাদেশ আনসার
            </label>
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="Fire">
                <span class="checkmark"></span> বাংলাদেশ ফায়ার সার্ভিস
            </label>
            <label class="checkbox-option">
                <input type="checkbox" name="wish[]" value="Others">
                <span class="checkmark"></span> অন্যান্য
            </label>
        </div>
    </div>
</div> -->
<input type="hidden" name="refer" value="<?= isset($_GET['refer']) ? htmlspecialchars($_GET['refer']) : 'null'; ?>">
<div class="form-group">
    <label for="password">পাসওয়ার্ড</label>
    <input type="text" name="password" id="password" placeholder="পাসওয়ার্ড প্রবেশ করান" required>
</div>


<button type="submit" class="submit-btn">রেজিস্টার</button>

<div class="signup-link">
    <?php
        $ref = isset($_GET['refer']) ? htmlspecialchars($_GET['refer']) : '';
        echo 'আগে থেকেই আছে ? <a href="auth/?refer=' . urlencode($ref) . '">লগইন করুন</a>';       
    ?>
</div>