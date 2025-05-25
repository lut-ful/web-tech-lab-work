<form action="../../control/seller/process.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Edit Profile</legend>
        <table>
            <tr>
                <td><label for="full_name">Full Name:</label></td>
                <td>
                    <input type="text" id="full_name" name="full_name" value="<?= retainValue('full_name', $values, $user) ?>">
                    <?= displayError('full_name', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td>
                    <input type="email" id="email" name="email" value="<?= retainValue('email', $values, $user) ?>">
                    <?= displayError('email', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="profile_picture">Profile Picture:</label></td>
                <td>
                    <?php if (!empty($user['profile_picture'])): ?>
                        <img src="../../uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" class="img-preview">
                    <?php endif; ?>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                    <?= displayError('profile_picture', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="phone">Phone Number:</label></td>
                <td>
                    <input type="tel" id="phone" name="phone" value="<?= retainValue('phone', $values, $user) ?>">
                    <?= displayError('phone', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="dob">Date of Birth:</label></td>
                <td>
                    <input type="date" id="dob" name="dob" value="<?= retainValue('dob', $values, $user) ?>">
                    <?= displayError('dob', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="skills">Skill:</label></td>
                <td>
                    <select id="skills" name="skills[]" multiple>
                        <option value="ml" <?= retainSelected('skills', 'ml', $values, $user) ?>>Machine Learning</option>
                        <option value="web_dev" <?= retainSelected('skills', 'web_dev', $values, $user) ?>>Web Development</option>
                        <option value="graphic_design" <?= retainSelected('skills', 'graphic_design', $values, $user) ?>>Graphic Design</option>
                        <option value="content_writing" <?= retainSelected('skills', 'content_writing', $values, $user) ?>>Content Writing</option>
                        <option value="seo" <?= retainSelected('skills', 'seo', $values, $user) ?>>SEO</option>
                    </select>
                    <?= displayError('skills', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="portfolio">Upload Portfolio:</label></td>
                <td>
                    <?php if (!empty($user['portfolio'])): ?>
                        <a href="../../uploads/<?= htmlspecialchars($user['portfolio']) ?>" target="_blank">View Portfolio</a>
                    <?php endif; ?>
                    <input type="file" id="portfolio" name="portfolio">
                    <?= displayError('portfolio', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="hours">Available Hours per Week:</label></td>
                <td>
                    <input type="number" id="hours" name="hours" min="1" max="168" value="<?= retainValue('hours', $values, $user) ?>">
                    <?= displayError('hours', $errors) ?>
                </td>
            </tr>
            <tr>
                <td>Preferred Withdraw Method:</td>
                <td>
                    <input type="radio" id="paypal" name="payment" value="paypal" <?= retainChecked('payment', 'paypal', $values, $user) ?>> <label for="paypal">PayPal</label>
                    <input type="radio" id="bank_transfer" name="payment" value="bank_transfer" <?= retainChecked('payment', 'bank_transfer', $values, $user) ?>> <label for="bank_transfer">Bank Transfer</label>
                    <input type="radio" id="crypto" name="payment" value="crypto" <?= retainChecked('payment', 'crypto', $values, $user) ?>> <label for="crypto">Cryptocurrency</label>
                    <?= displayError('payment', $errors) ?>
                </td>
            </tr>
            <tr>
                <td><label for="about_you">About You:</label></td>
                 
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="hidden" name="action" value="update"><!-- Added for CRUD update -->
                    <input type="hidden" name="old_email" value="<?= htmlspecialchars($user['email']) ?>"><!-- Use old_email for identification -->
                    <input type="submit" value="Save All">
                    <input type="reset" value="Reset">
                    <a href="seller_dashboard.php" class="cancel-btn" style="text-decoration:none;">Cancel</a>
                </td>
            </tr>
        </table>
    </fieldset>
</form>
