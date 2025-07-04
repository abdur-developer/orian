<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    if($id != null){
        $sql = "SELECT * FROM questions WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        // Decode options if it's stored as JSON
        if(isset($row['options']) && !empty($row['options'])) {
            $row['options'] = json_decode($row['options'], true);
        }
    }else{
        $row = [
            'id' => null,
            'question' => null,
            'answer' => null,   //1
            'options' => ["","","",""], // Default empty options
            'explanation' => null
        ];
    }
?>

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Post Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form action="action/update_questions.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        
                        <!-- Question Text -->
                        <div class="form-floating mb-4">
                            <textarea name="question" class="form-control" id="question" 
                                      style="height: 120px" required><?= htmlspecialchars($row['question']) ?></textarea>
                            <label for="question"><i class="fas fa-question me-1 text-muted"></i>Question</label>
                            <div class="invalid-feedback">Please provide a question</div>
                        </div>
                        
                        <!-- Explanation -->
                        <div class="form-floating mb-4">
                            <textarea name="explanation" class="form-control" id="explanation" 
                                      style="height: 120px"><?= htmlspecialchars($row['explanation']) ?></textarea>
                            <label for="explanation"><i class="fas fa-info-circle me-1 text-muted"></i>Explanation</label>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Answer Options -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-list-ol me-1 text-muted"></i>Options</label>
                            <?php for($i = 0; $i < 4; $i++): ?>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><?= $i+1 ?></span>
                                    <input type="text" name="options[]" class="form-control" 
                                           value="<?= htmlspecialchars($row['options'][$i] ?? '') ?>" required>
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="answer" 
                                               value="<?= $i ?>" <?= ($row['answer'] == $i) ? 'checked' : '' ?> required>
                                    </div>
                                </div>
                            <?php endfor; ?>
                            <div class="form-text">Select the correct answer by checking the radio button</div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
// Form validation
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})();
</script>