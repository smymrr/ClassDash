<?php
/**
 * includes/modals/add_income_modal.php
 */
?>
<div id="modal-add-income" class="cd-modal-overlay hidden">
    <div class="cd-modal">
        <header class="cd-modal__header">
            <h3 class="cd-modal__title">Add Income</h3>
            <button type="button" class="cd-modal__close" onclick="closeModal('modal-add-income')" aria-label="Close modal">&times;</button>
        </header>

        <form action="/treasury/income/store" method="POST" class="cd-modal__form">
            <div class="cd-modal__grid">
                <div class="cd-field">
                    <label class="cd-field__label">Date *</label>
                    <input type="date" name="date" class="cd-input" value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="cd-field">
                    <label class="cd-field__label">Amount (Rp) *</label>
                    <input type="number" name="amount" class="cd-input cd-font-mono" placeholder="50000" min="1" step="1" required>
                </div>
            </div>

            <div class="cd-field">
                <label class="cd-field__label">Category *</label>
                <select name="category" class="cd-input" required>
                    <option value="Monthly Dues">Monthly Dues</option>
                    <option value="Donation">Donation</option>
                    <option value="Event">Event</option>
                    <option value="Other" selected>Other</option>
                </select>
            </div>

            <div class="cd-field">
                <label class="cd-field__label">Description *</label>
                <input type="text" name="description" class="cd-input" placeholder="Brief description of this transaction" required>
            </div>

            <div class="cd-field">
                <label class="cd-field__label">Related Person</label>
                <input type="text" name="related_person" class="cd-input" placeholder="Student name (optional)">
            </div>

            <footer class="cd-modal__footer">
                <button type="button" class="cd-btn cd-btn--ghost" onclick="closeModal('modal-add-income')">Cancel</button>
                <button type="submit" class="cd-btn cd-btn--primary">Add transaction</button>
            </footer>
        </form>
    </div>
</div>

</html>