<?php
$styles = ['../assets/css/pages/members.css'];
require dirname(__DIR__, 2) . '/includes/layouts/header.php';
?>

<div class="cd-members">
    <div class="cd-members__card">
        <table class="cd-table cd-members-table">
            <thead>
                <tr>
                    <th scope="col" colspan="2">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Unpaid Debt</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $m): ?>
                    <?php
                        $name      = $m['fullname'];
                        $initial   = mb_strtoupper(mb_substr(trim($name), 0, 1));
                        $roleLabel = ucwords(str_replace(['_', '-'], ' ', $m['role']));
                        $roleSlug  = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $m['role']), '-'));
                        $unpaid    = (int) $m['unpaid_total'];
                    ?>
                    <tr class="cd-member">
                        <td class="cd-member__avatar">
                            <span class="cd-avatar" aria-hidden="true"><?= htmlspecialchars($initial) ?></span>
                        </td>
                        <td class="cd-member__name"><?= htmlspecialchars($name) ?></td>
                        <td class="cd-member__email"><?= htmlspecialchars($m['email']) ?></td>
                        <td class="cd-member__role">
                            <span class="cd-role cd-role--<?= htmlspecialchars($roleSlug) ?>"><?= htmlspecialchars($roleLabel) ?></span>
                        </td>
                        <td class="cd-member__debt <?= $unpaid > 0 ? 'cd-member__debt--due' : 'cd-member__debt--none' ?>" data-label="Unpaid">
                            Rp <?= htmlspecialchars(number_format($unpaid, 0, ',', '.')) ?>
                        </td>
                        <td class="cd-member__actions">
                            <button type="button" class="cd-kebab" data-member-id="<?= (int) $m['id'] ?>" aria-label="Actions for <?= htmlspecialchars($name) ?>">
                                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <circle cx="12" cy="5" r="1.75"/>
                                    <circle cx="12" cy="12" r="1.75"/>
                                    <circle cx="12" cy="19" r="1.75"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($members)): ?>
                    <tr>
                        <td class="cd-members__empty" colspan="6">PLACEHOLDER_NO_MEMBERS_MESSAGE_SIDEBAR</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require dirname(__DIR__, 2) . '/includes/layouts/footer.php'; ?>