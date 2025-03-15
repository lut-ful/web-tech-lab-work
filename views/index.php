<html>
<head>
    <title>Pet Valley</title>
</head>
<body>
    <h1>Welcome to the official website of Pet Valley</h1>
    <h2>Biggest Marketplace to buy or sell pets</h2>
    <h3>Please fill up the form to sell your pets</h3>

    <form action="register.php" method="POST">
        <fieldset>
            <legend>Seller Registration</legend>
            <table>
                <tr>
                    <td><label for="seller_name">Full Name:</label></td>
                    <td><input type="text" id="seller_name" name="seller_name" required></td>
                </tr>
                <tr>
                    <td><label for="business_name">Business Name:</label></td>
                    <td><input type="text" id="business_name" name="business_name" required></td>
                </tr>
                <tr>
                    <td><label for="contact_number">Contact Number:</label></td>
                    <td><input type="tel" id="contact_number" name="contact_number" required></td>
                </tr>
                <tr>
                    <td><label for="pet_category">Pet Category:</label></td>
                    <td>
                        <select id="pet_category" name="pet_category">
                            <option value="mammals">Mammals</option>
                            <option value="birds">Birds</option>
                            <option value="reptiles">Reptiles</option>
                            <option value="aquatic">Aquatic</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="price_range">Price Range:</label></td>
                    <td><input type="number" id="price_range" name="price_range" min="1" required></td>
                </tr>
                <tr>
                    <td><label for="description">Description:</label></td>
                    <td><textarea id="description" name="description" rows="3" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="availability">Availability:</label></td>
                    <td>
                        <input type="radio" id="available" name="availability" value="available" required>
                        <label for="available">Available</label>
                        <input type="radio" id="not_available" name="availability" value="not_available">
                        <label for="not_available">Not Available</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit">Register</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</body>
</html>