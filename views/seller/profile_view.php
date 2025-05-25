<div class="profile-card">
    <div class="profile-header">
        <?php if (!empty($user['profile_picture'])): ?>
            <img src="../../uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" class="profile-avatar">
        <?php else: ?>
            <div class="profile-avatar profile-avatar-placeholder"></div>
        <?php endif; ?>
        <div class="profile-name"><?= htmlspecialchars($user['full_name']) ?></div>
        <div class="profile-email"><?= htmlspecialchars($user['email']) ?></div>
    </div>
    <div class="profile-details">
        <div><span class="profile-label">Phone:</span> <?= htmlspecialchars($user['phone']) ?></div>
        <div><span class="profile-label">Date of Birth:</span> <?= htmlspecialchars($user['dob']) ?></div>
        <div><span class="profile-label">Skills:</span> <?= htmlspecialchars($user['skills']) ?></div>
        <div><span class="profile-label">Available Hours Per Week:</span> <?= htmlspecialchars($user['hours']) ?></div>
        <div><span class="profile-label">Preferred Payment Method:</span> <?= htmlspecialchars($user['payment']) ?></div>
        <div><span class="profile-label">About You:</span>
            <div class="profile-about"><?= nl2br(htmlspecialchars($user['about_you'])) ?></div>
        </div>
<?php if (!empty($user['portfolio'])): ?>
    <div><span class="profile-label">Portfolio:</span>
        <a href="../../uploads/<?= htmlspecialchars($user['portfolio']) ?>" target="_blank" class="profile-portfolio-link">View Portfolio</a>
    </div>
<?php endif; ?>
    </div>
    <div class="profile-actions">
        <a href="dashboard.php?edit=1" class="crud-btn edit-btn">Edit Profile</a>
        <form action="../../views/seller/seller_delete.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
            <button type="submit" class="crud-btn delete-btn">Delete Account</button>
        </form>
    </div>
</div>
