<form action="index.php?page=registerProcess" method="post">
    Username:<input type="text" name="username"><br><br>
    Password:<input type="password" name="password"><br><br>
    Gender:
    <input type="radio" name="gender" value="male"> Male
    <input type="radio" name="gender" value="female"> Female <br><br>
    <label for="address">Address</label>
    <select name="address" id="address">
        <option value="hanoi">Hà Nội</option>
        <option value="tphcm">TP.HCM</option>
        <option value="hue">Huế</option>
        <option value="danang">Đà Nẵng</option>
    </select><br><br>
    <label>Enable Programming Language:</label><br>
    <input type="checkbox" name="lang" value="php"> PHP
    <input type="checkbox" name="lang" value="csharp"> C#
    <input type="checkbox" name="lang" value="java"> Java
    <input type="checkbox" name="lang" value="cpp"> C++
    <br><br>
    <label>Skill:</label><br>
    <input type="radio" name="skill" value="normal"> Normal <br>
    <input type="radio" name="skill" value="good"> Good <br>
    <input type="radio" name="skill" value="verygood"> Very Good <br>
    <input type="radio" name="skill" value="excellent"> Excellent
    <br><br>
    <label>Note:</label><br>
    <textarea name="note" rows="4" cols="30"></textarea>
    <br><br>
    <input type="submit" name="register" value="Register">
    <input type="reset" value="Reset">
</form>