<div class="settings-textbox-edit">
        <p>Email - <?php 
         if($profile != null){
            $profile->getEmail();} ?></p>
        <div class = editButtonDiv>
            <a href="#email" class="editButton">EDIT</a>
        </div>
        </div>
       <div class = "overlay" id= "email">
            <div class = "wrapper">
                <h2>Enter your new Email</h2>
                <?php if(isset($_GET["error"])){
                                if($_GET["error"] == "EMAILTAKEN"){
                                    echo "<p style=\"color: red;\">This Email is taken, try another</p> <br>";
                                }
                                else{
                                    echo "<br>";
                                }
                            }
                            ?>
                <a href="#" class = "close">&times;</a>
                <div class="content">
                    <div class="containter">
                        <form action="private/changeEmail.php" method="post">
                            <label class = "red">Enter Email</label><br>
                            <input type="email" placeholder="Email" name="email" required><br>
                            <label>Re-Enter Email</label><br>
                            <input type = "email" placeholder="Email" name="email2" required><br><br>
                            <input type="submit" value="submit">
                        </form>
                    </div>
                </div>
            </div>
       </div>
       <div class="settings-textbox-edit">
         
        <p>Username - <?php 
         if($profile != null){
            echo $_SESSION["username"];} ?></p>
                <div class = editButtonDiv>
            <a href="#username" class="editButton">EDIT</a>
        </div>
        </div>
       <div class = "overlay" id= "username">
            <div class = "wrapper">
                <h2>Enter your new Username</h2>
                <?php if(isset($_GET["error"])){
                                if($_GET["error"] == "USERNAMETAKEN"){
                                    echo "<p style=\"color: red;\">This username is taken, try another</p> <br>";
                                }
                                else{
                                    echo "<br>";
                                }
                            }
                            ?>
                <a href="#" class = "close">&times;</a>
                <div class="content">
                    <div class="containter">
                        <form action="private/changeUsername.php" method="post">
                            <label class = "red">Enter username</label><br>
                            <input type="text" placeholder="username" name="username" pattern="^[a-zA-Z0-9!?]*$"><br><br>
                            <label>Re-Enter username</label><br>
                            <input type = "text" placeholder="username" name="username2"><br><br>
                            <input type="submit" value="submit">
                        </form>
                    </div>
                </div>
            </div>
       </div>
       </div>