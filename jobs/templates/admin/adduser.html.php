<main class="sidebar">


    <form action="../admin/adduser" method="POST" style="padding: 40px">
        <label> ADD USERNAME </label>
        <input type="text" name="username"/>

        <label> E-MAIL </label>
        <input type="text" name="email"/>

        <label> ENTER FULL NAME </label>
        <input type="text" name="name"/>

        <label> ENTER USERTYPE </label>
        <select name="user_type" id=""/>
            <option value ="admin">ADMIN</option>
             <option value ="client">CLIENT</option>
        </select>

        <label> ENTER PASSWORD </label>
        <input type="password" name="password"/>

        <input type="submit" name="submit" value="Create User"/>
    </form>
</main>

