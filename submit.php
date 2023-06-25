<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <script src="scripts.js"></script>
        <link rel="stylesheet" href="submit.css">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap|Sofia" rel="stylesheet">
        <script src="https://kit.fontawesome.com/48d28d329b.js" crossorigin="anonymous"></script>
        <title>Submission</title>
    </head>
    <body>
        <nav id="NavTop">
          <button type="button" name="button" id="Login">

          </button>
          <input type="text" placeholder="&#x1F50E;&#xFE0E; Search.." id="SearchBox">
          <a href="index.php" id="Logo">
            <img src="images/logo_transperent_bg.png" alt="logo image" class="Logo">
          </a>
        </nav>
        <br><br><br><br>
        <div id="Background">
            <img src="background.png" class="background">
        </div>
        <h1 id = "Header" class="positioned">Create a Submission</h1>
        <!-- This Creates Two Sections for Recipes or Skills -->
        <div class="NavMid positioned">
            <button class="sectionlinks" onclick="showSection(event, 'Recipe')">Recipe</button>
            <button class="sectionlinks button2" onclick="showSection(event, 'Skill')">Skill</button>
        </div>
        <hr id="line1">


        <!-- Creates the Recipe Side with Associated Inputs -->
        <div id="Recipe" class="sectioncontent" style = "display: none;">
            <form id = "form" action = "addRecipe.php" enctype="multipart/form-data" method="post">
                <br>

                <label id="foodNameLabel" for = "foodName" class = "required">Essential Information:</label><br>
                <input type = "text" id = "foodName" placeholder="Recipe Name and Preparation Time" name = "foodName" required>

                <input type = "text" id = "prepTime" placeholder="mins." name = "prepTime" required><br><br>

                <input type = "text" id = "description" placeholder="Short Description (140 characters)" name = "description" maxlength = "140" required><br><br>

                <div class="selectZone">
                    <label for = "difficulty" class = "required designedForSelect">Difficulty Level</label><br>
                    <hr class="lineInner">
                    <select name = "difficulty" id = "difficulty" name = "difficulty" required>
                        <option value = "Very Easy">Very Easy</option>
                        <option value = "Easy">Easy</option>
                        <option value = "Medium">Medium</option>
                        <option value = "Hard">Hard</option>
                        <option value = "Very Hard">Very Hard</option>
                    </select>
                </div><br><br>

                <!-- This Creates the Dropdown List of Countries -->
                <div class="selectZone" id="selectZoneCountry">
                    <label for = "country" class = "required designedForSelect">Recipe Country of Origin</label><br>
                    <hr class="lineInner">
                    <select name = "country" id = "country" required>

                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>

                    </select>
                </div><br><br>

                <label class = "required" id="fileToUploadLabel">Include an Image:</label><br>

                <div class="imageUpload">
                    <label for="fileToUpload" id="k">
                        <img id="t" class="imageIcon" src="images/image_icon.png">
                        <!--<img id="output" width="50px">-->
                    </label>
                    <input type = "file" id = "fileToUpload" name = "fileToUpload" accept = "image/png, image/jpeg" onchange="loadFile(event)"><br>
                    <label class="designedForImage" for="fileToUpload">Upload an Image</label>
                </div><br><br>

                <label for = "ingredient1" class = "required" id=ingredientLabel>Ingredients</label><br>

                <div id = "ingredientDiv">
                    <!-- Creates the Ingredient Inputs using the "createNewInput()" Javascript Function -->
                    <input type = "text" class = "ingredient" placeholder="Ingredient 1:" name = "ingredient1" required><br>

                    <input type = "button" id = "newIngredient" value = "Add Ingredient" style="width: 89%;" onclick = "createNewInput('Ingredient')">
                </div>

                <!-- Creates the Step Inputs using the "createNewInput()" Javascript Function -->
                <br>
                <label for = "step1" class = "required" id="stepLabel">Step 1</label><br>
                <div id="stepDiv">
                    <input type = "text" class="step" placeholder="Step 1:" name = "step1" required><br>

                    <input type = "button" id = "newStep" value = "Add Step" style="width: 89%;" onclick = "createNewInput('Step')">
                </div><br>
                <hr id="line2">
                <input type = "submit" id = "submitStep" value = "Submit">

            </form>
        </div>

        <!-- Creates the Skills Side with Associated Inputs-->
        <div id="Skill" class="sectioncontent" style = "display: none;">
            <form id = "skillForm">
                <br>
                <label id="skillNameLabel" for = "skillName">Coming Soon!</label><br>
            </form>
        </div>
    </div>
    </body>
    <script type="text/javascript">
    let usernameSession = "<?php if(isset($_SESSION['username'])) {
                                  echo($_SESSION['username']);}
                                  else {
                                    echo(null);
                                  }
      ?>";

      if (usernameSession != null && usernameSession != ""){
        document.getElementById("Login").innerHTML = "<i class=\"fa-regular fa-user user-icon\" style=\"color: var(--orange);\"></i>\
                                                     <pre class=\"user-name\">" + usernameSession + "</pre>\
                                                     <i class=\"fa-solid fa-chevron-up chevron-login\" style=\"color: var(--orange)\"></i>\
                                                     <div id=\"drop-menu-container\">\
                                                     </div>";
        document.getElementById("drop-menu-container").innerHTML = "<div class=\"drop-menu-LoggedIn\">\
                                                                     <a href=\"profile.php?username=" + usernameSession + "\">Profile Page</a>\
                                                                     <a href=\"submit.php\">Submit Recipe</a>\
                                                                     <a href=\"deletesession.php\">Log Out</a>\
                                                                   </div>";
     }

     if (usernameSession == null || usernameSession == "") {
     document.getElementById("Login").innerHTML = "<i class=\"fa-regular fa-user user-icon\" style=\"color: var(--orange);\"></i>\
                                                   <pre class=\"user-name\">Login</pre>\
                                                   <i class=\"fa-solid fa-chevron-up chevron-login\" style=\"color: var(--orange)\"></i>\
                                                   <div id=\"drop-menu-container\">\
                                                   </div>";

     document.getElementById("drop-menu-container").innerHTML = "<div class=\"drop-menu\">\
                                                                    <a href=\"login.php\">Log in</a>\
                                                                 </div>";
   }

   var search = document.getElementById("SearchBox");
   search.addEventListener("keypress", function(event) {
     // If the user presses the "Enter" key on the keyboard
     if (event.key === "Enter") {
       window.location.href = "/searchpage.php?search=" + search.value;
     }
   });

    </script>
</html>
