<div id="right-edit" class="profile-right">
       <h4>Edit Profile</h4>
       <div class="edit-nav">
         <button class="edit-links" onclick="showEditSection(event, \'main-profile-edit\')" id="defaultOpenEdit">User Info</button>
         <button class="edit-links" onclick="showEditSection(event, \'password-edit\')">Password</button>
       </div>
       <div id="main-profile-edit" class="right-edit-content">
         <div class="edit-wrapper">
            <label for="">Username:</label>
            <input type="text" name="" value="">
         </div>
         <div class="edit-wrapper">
            <label for="">Email:</label>
            <input type="text" name="" value="">
         </div>
       </div>
       <div id="password-edit" class="right-edit-content">
         <div class="edit-wrapper">
            <label for="">Current Password:</label>
            <input type="password" id="password-current">
         </div>
         <div class="edit-wrapper">
            <label for="">Enter new Password:</label>
            <input type="password" id="password-new1">
         </div>
         <div class="edit-wrapper">
            <label for="">Reenter new Password:</label>
            <input type="password" id="password-new2">
         </div>
       </div>
       <button type="button" name="button" id="view-profile" onclick="showRightProfile(\'event\', \'right-no-edit\')">View Profile</button>
     </div>