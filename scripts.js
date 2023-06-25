function showSection(evt, sectionName) {
  // Declare all variables
  var i, sectioncontent, sectionlinks;

  // Get all elements with class="tabcontent" and hide them
  sectioncontent = document.getElementsByClassName("sectioncontent");
  for (i = 0; i < sectioncontent.length; i++) {
    sectioncontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  sectionlinks = document.getElementsByClassName("sectionlinks");
  for (i = 0; i < sectionlinks.length; i++) {
    sectionlinks[i].className = sectionlinks[i].className.replace(" used", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(sectionName).style.display = "grid";
  evt.currentTarget.className += " used";
}


function showLogin(evt, name) {
  var i, loginSections;

  // Get all elements with class="loginSections" and hide them
  loginSections = document.getElementsByClassName("loginSections");
  for (i = 0; i < loginSections.length; i++) {
    loginSections[i].style.display = "none";
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(name).style.display = "flex";

}

function showRightProfile(evt, sectionName) {
  // Declare all variables
  var i, rightSections;

  // Get all elements with class="tabcontent" and hide them
  rightSections = document.getElementsByClassName("profile-right");
  for (i = 0; i < rightSections.length; i++) {
    rightSections[i].style.display = "none";
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(sectionName).style.display = "flex";
}


function showEditSection(evt, sectionName) {
  // Declare all variables
  var i, editSections, editLinks;

  // Get all elements with class="tabcontent" and hide them
  editSections = document.getElementsByClassName("right-edit-content");
  for (i = 0; i < editSections.length; i++) {
    editSections[i].style.display = "none";
  }

  editLinks = document.getElementsByClassName("edit-links");
  for (i = 0; i < editLinks.length; i++) {
    editLinks[i].className = editLinks[i].className.replace(" used", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(sectionName).style.display = "flex";
  evt.currentTarget.className += " used";
}

function getCookie(name = "username") { //When this is called, if null is returned the user is not logged in
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + name + '=([^;]*)')); //Check if a cookie exists with the given name (username)
    return match ? match[1] : null; //Return the value of the cookie if it exists, or null otherwise
}

// function setCookie(name, value, options = {}) { //Create a cookie, set name to "username" and value to the users username

//   options = {
//     path: '/',
//     secure: true,
//     'max-age': 3000000, //Keep user logged in for ~35 days
//     ...options
//   };

//   if (options.expires instanceof Date) {
//     options.expires = options.expires.toUTCString();
//   }

//   let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value); //create updated cookie, format username=usernameGiven

//   for (let optionKey in options) { //Add each option to the cookie
//     updatedCookie += "; " + optionKey;
//     let optionValue = options[optionKey];
//     if (optionValue !== true) {
//       updatedCookie += "=" + optionValue;
//     }
//   }

//   document.cookie = updatedCookie; //Save the cookie to the browser
// }


var stepCount = 1, stepLimit = 10, ingredientCount = 1, ingredientHeight = 152, stepHeight = 152;

function createNewInput(inputType) {
  // Limit number of steps to 10
  if (stepCount < stepLimit || inputType == "Ingredient") {

    if (inputType == "Step") {
      stepCount++;
      count = stepCount;
    }
    else if (inputType == "Ingredient") {
      ingredientCount++;
      count = ingredientCount;
    }


    // Removes "add step" button and "submit" button
    document.getElementById("new" + inputType).remove();
    if (count != 2)
      document.getElementById("delete" + inputType).remove();
    if (inputType == "Step") {
    document.getElementById("submit" + inputType).remove();
    }

    // Create new label field to describe step
    //var newLabel = document.createElement("label");
    //newLabel.htmlFor = inputType.toLowerCase() + count;
    //newLabel.innerHTML = "<br><br>" + inputType + " " + count + "<br>";
    //if (inputType == "Step") {
      //document.getElementById('form').appendChild(newLabel);
    //}
    //else if (inputType == "Ingredient") {
      //document.getElementById('ingredientDiv').appendChild(newLabel);
    //}

    // Create new input field for each step with an incremented id
    var newStep = document.createElement("input");
    newStep.type = "text";
    newStep.name = inputType.toLowerCase() + count;
    if (inputType == "Step") {
      newStep.setAttribute("class", "step");
      newStep.id = "step" + count;
      newStep.placeholder = "Step " + count + ":";
      stepHeight += 70;
      let stepHeightString = stepHeight.toString() + "px";
      document.getElementById('stepDiv').appendChild(newStep);
      document.getElementById('stepDiv').style.height = stepHeightString;
    }
    else if (inputType == "Ingredient") {
      newStep.setAttribute("class", "ingredient");
      newStep.id = "ingredient" + count;
      newStep.placeholder = "Ingredient " + count + ":";
      ingredientHeight += 70;
      let ingredientHeightString = ingredientHeight.toString() + "px";
      document.getElementById('ingredientDiv').appendChild(newStep);
      document.getElementById('ingredientDiv').style.height = ingredientHeightString;
    }

    // If statement prevents "Add Step" button showing if limit is reached
    if (stepCount < stepLimit || inputType == "Ingredient") {
      //Create new button to add next step for improved formatting
      var newButton = document.createElement("input");
      newButton.type = "button";
      newButton.id = "new" + inputType;
      newButton.setAttribute("onclick", "createNewInput(" + '\'' + inputType + '\'' + ")");
      newButton.setAttribute("value", "Add " + inputType);
      var deleteButton = document.createElement("input");
      deleteButton.type = "button";
      deleteButton.id = "delete" + inputType;
      deleteButton.setAttribute("onclick", "deleteLastInput(" + "\'" + inputType + "\'" + ")");
      deleteButton.setAttribute("value", "Delete Last " + inputType);
      if (inputType == "Step") {
        document.getElementById('stepDiv').appendChild(newButton);
        document.getElementById("stepDiv").appendChild(deleteButton);
      }
      else if (inputType == "Ingredient") {
        document.getElementById('ingredientDiv').appendChild(newButton);
        document.getElementById("ingredientDiv").appendChild(deleteButton);
      }
    }
    if(stepCount == stepLimit && inputType == "Step")
    {
      var deleteButton = document.createElement("input");
      deleteButton.type = "button";
      deleteButton.id = "delete" + inputType;
      deleteButton.setAttribute("onclick", "deleteLastInput(" + "\'" + inputType + "\'" + ")");
      deleteButton.setAttribute("value", "Delete Last " + inputType);
      document.getElementById("stepDiv").appendChild(deleteButton);
      document.getElementById("deleteStep").style.marginLeft = "5%";
      document.getElementById("deleteStep").style.width = "89%";
    }

    if (inputType == "Step") {
      // Create new submit button
      var newSubmit = document.createElement("input");
      newSubmit.type = "submit";
      newSubmit.id = "submit" + inputType;
      newSubmit.setAttribute("value", "Submit");
      document.getElementById('form').appendChild(newSubmit);
    }
  }
}


function deleteLastInput(inputType)
{
  if (inputType == "Ingredient")
  {
    count = ingredientCount;
  }
  else if (inputType == "Step")
  {
    count = stepCount;
  }

  if(stepCount != stepLimit)
    document.getElementById("new" + inputType).remove();
  document.getElementById("delete" + inputType).remove();

  if (inputType == "Ingredient")
  {
    document.getElementById("ingredient" + count).remove();
    ingredientHeight -= 70;
    let ingredientHeightString = ingredientHeight.toString() + "px";
    document.getElementById("ingredientDiv").style.height = ingredientHeightString;
    count--;
    ingredientCount = count;
  }
  else if(inputType == "Step")
  {
    document.getElementById("step" + count).remove();
    stepHeight -=70;
    let stepHeightString = stepHeight.toString() + "px";
    document.getElementById("stepDiv").style.height = stepHeightString;
    count--;
    stepCount = count;
  }

  var newButton = document.createElement("input");
  newButton.type = "button";
  newButton.id = "new" + inputType;
  newButton.setAttribute("onclick", "createNewInput(" + '\'' + inputType + '\'' + ")");
  newButton.setAttribute("value", "Add " + inputType);
  var deleteButton = document.createElement("input");
  deleteButton.type = "button";
  deleteButton.id = "delete" + inputType;
  deleteButton.setAttribute("onclick", "deleteLastInput(" + "\'" + inputType + "\'" + ")");
  deleteButton.setAttribute("value", "Delete Last " + inputType);
  if (inputType == "Step")
  {
    document.getElementById('stepDiv').appendChild(newButton);
    if (count != 1)
      document.getElementById("stepDiv").appendChild(deleteButton);
    else
      document.getElementById("newStep").style.width = "89%";
  }
  else if (inputType == "Ingredient") {
    document.getElementById('ingredientDiv').appendChild(newButton);
    if (count != 1)
      document.getElementById("ingredientDiv").appendChild(deleteButton);
    else
      document.getElementById("newIngredient").style.width = "89%";
  }
}

var loadFile = function(event)
{
  var outputImage = document.createElement("img");
  outputImage.id = "output";
  outputImage.width = "100";
  // var image = document.getElementById("output");
  outputImage.src = URL.createObjectURL(event.target.files[0]);
  document.getElementById("k").appendChild(outputImage);
  var iconDelete = document.getElementById("t");
  iconDelete.parentNode.removeChild(iconDelete);
}

function deleteAllCookies() {
    const cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i];
        const eqPos = cookie.indexOf("=");
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}
