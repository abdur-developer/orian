<?php 
    if(!isset($_SESSION['otp_time'])) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Ops...',
                text: 'OTP not requested. Please request a new OTP.'
                }).then(() => {
                    window.location.href = 'index.php?forgot';
                });
        </script>";
        exit();
    }
    $otp_expire_time = $_SESSION['otp_time'] + 300;

?>
<div class="timer-container" id="timer">
    OTP মেয়াদ শেষ হতে বাকি: ৫:০০
</div>

<div class="form-group">
    <div class="otp-inputs">
        <input type="text" class="otp-input" maxlength="1" data-index="1" autocomplete="off"/>
        <input type="text" class="otp-input" maxlength="1" data-index="2" autocomplete="off"/>
        <input type="text" class="otp-input" maxlength="1" data-index="3" autocomplete="off"/>
        <input type="text" class="otp-input" maxlength="1" data-index="4" autocomplete="off"/>
        <input type="text" class="otp-input" maxlength="1" data-index="5" autocomplete="off"/>
        <input type="text" class="otp-input" maxlength="1" data-index="6" autocomplete="off"/>
    </div>
    <input type="hidden" name="input_otp" id="otpValue"/>
</div>

<button type="submit" class="submit-btn" id="submitBtn" disabled>যাচাই করুন</button>

<div class="resend-otp">
    <a href="index.php?forgot" id="resendLink" style="display: none;">ওটিপি পুনরায় পাঠান</a>
</div>

<div class="signup-link">
    পাসওয়ার্ড মনে আছে ? <a href="index.php">লগইন করুন</a>
</div>


<script>
    // OTP Input Handling
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpValue = document.getElementById('otpValue');
    const submitBtn = document.getElementById('submitBtn');
    const timerElement = document.getElementById('timer');
    const resendLink = document.getElementById('resendLink');
    
    // Focus on first OTP input on page load
    window.addEventListener('load', () => {
        otpInputs[0].focus();
    });
    
    // Handle OTP input
    otpInputs.forEach(input => {
        input.addEventListener('input', (e) => {
            const value = e.target.value;
            const index = parseInt(e.target.dataset.index);
            
            // Only allow numbers
            if (!/^\d*$/.test(value)) {
                e.target.value = '';
                return;
            }
            
            // If a digit is entered, move to next input
            if (value.length === 1 && index < 6) {
                otpInputs[index].focus();
            }
            
            // Update OTP value and check if complete
            updateOTPValue();
            checkOTPComplete();
        });
        
        input.addEventListener('keydown', (e) => {
            // Handle backspace
            if (e.key === 'Backspace') {
                const index = parseInt(e.target.dataset.index);
                
                if (e.target.value === '' && index > 1) {
                    otpInputs[index - 2].focus();
                }
                
                e.target.value = '';
                
                updateOTPValue();
                checkOTPComplete();
            }
        });
        
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = e.clipboardData.getData('text');
            
            // Only allow numbers and exactly 6 digits
            if (/^\d{6}$/.test(pasteData)) {
                // Fill all inputs with pasted data
                for (let i = 0; i < 6; i++) {
                    otpInputs[i].value = pasteData[i];
                    otpInputs[i].classList.add('filled');
                }
                
                // Update OTP value and check if complete
                updateOTPValue();
                checkOTPComplete();
                
                // Focus the last input
                otpInputs[5].focus();
            }
        });
    });
    
    // Update the hidden OTP value
    function updateOTPValue() {
        let otp = '';
        otpInputs.forEach(input => {
            otp += input.value;
            if (input.value) {
                input.classList.add('filled');
            } else {
                input.classList.remove('filled');
            }
        });
        otpValue.value = otp;
    }
    
    // Check if OTP is complete (all 6 digits)
    function checkOTPComplete() {
        const otp = otpValue.value;
        if (otp.length === 6) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }
    
    // Timer functionality
    let expireTime = <?php echo $otp_expire_time; ?> * 1000; // Convert to milliseconds
    
    function updateCountdown() {
        let now = new Date().getTime();
        let distance = expireTime - now;
        
        if (distance <= 0) {
            timerElement.innerHTML = "OTP মেয়াদ শেষ!";
            timerElement.classList.add('timer-expired');
            submitBtn.disabled = true;
            resendLink.classList.remove('disabled');
            resendLink.style.display = "block"
            clearInterval(timerInterval);
            document.querySelectorAll('input[type="text"]').forEach(input => {
                input.disabled = true;
                input.blur();
            });
            return;
        }
        
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        timerElement.innerHTML = "OTP মেয়াদ শেষ হতে বাকি: " + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
    }
    
    // Update countdown every second
    let timerInterval = setInterval(updateCountdown, 1000);
    updateCountdown(); // Initial call
</script>