<html lang="en">
<head>
  <title>Web service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<style>
    .jumbotron{ background-color:#83b047 !important; }
    .webserive p span{ font-size:21px; }
    .webserive ul li{ list-style: none;font-size:16px;float: left;margin-left: 10px; }
</style>
<body>

<div class="container">

  <div class="jumbotron" >
    <h1>Looking App Web service</h1>
    <p>Use below links for service request :- </p>
    <p>Base url : http://www.unifiedwebdevelopment.com/looking_app/users/</p>
  </div>
  
  <div class="row">
    <div class="col-sm-6">
        <div class="webserive">
      <h3>1. Registration</h3>
       <p><span>Link:</span>
       <a href="#">registration</a>
       </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>screen_name ,</li>
        <li>email ,</li>
        <li>password ,</li>
        <li>country ,</li>
        <li>lat,</li>
        <li>long,</li>
        <li>device_token,</li>
        <li>device_type (android , ios),</li>
        <li>accuracy,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
     </ul>
    </div>
    </div>
   <div class="col-sm-6">
        <div class="webserive">
      <h3>2. Login</h3>
       <p><span>Link:</span><a href="#">login</a>
      </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>email ,</li>
        <li>password ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
        <li>device_token,</li>
        <li>device_type(android , ios),</li>
     </ul>
    </div>
    </div>

 </div>

  <div class="row">
    <div class="col-sm-6">
        <div class="webserive">
      <h3>3. Profile(Create And Edit) </h3>
       <p><span>Link:</span>
       <a href="#">profile</a>
       </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>userid(same value as user_id) ,</li>
        <li>birthday ,</li>
        <li>identity ,</li>
         <li>ethnicity ,</li>
         <li>height ,</li>
         <li>height_cm ,</li>
         <li>weight ,</li>
         <li>Weight_kg ,</li>
         <li>about_me ,</li>
         <li>his_identitie ,</li>
         <li>relationship_status ,</li>
         <li>where_I_leave ,</li>
         <li>facebook_link ,</li>
         <li>twitter_link ,</li>
         <li>linkedin_link </li>
        
     </ul>
    </div>
    </div>
   <div class="col-sm-6">
        <div class="webserive">
      <h3>4. Profile Details </h3>
       <p><span>Link:</span><a href="#">profile_details</a>
      </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
         <li>user_id ,</li>
         <li>userid ,</li>
         <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
     </ul>
    </div>
    </div>
 </div>

 <div class="row">
    <div class="col-sm-6">
        <div class="webserive">
      <h3>5. Browse Matches Grid</h3>
       <p><span>Link:</span>
       <a href="#">find_members</a>
       </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>userid ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
     </ul>
    </div>
    </div>
   <div class="col-sm-6">
        <div class="webserive">
      <h3>6. Upload Profile Picture </h3>
       <p><span>Link:</span><a href="#"> profile_picture</a>
      </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>userid ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
        <li>pic(send image)</li>
        <li>profile_pic_type(1 means face pic 2 means verified photo)</li>
     </ul>
    </div>
    </div>
 </div>

 <div class="row">
    <div class="col-sm-6">
        <div class="webserive">
      <h3>7. Upload Album Images</h3>
       <p><span>Link:</span>
       <a href="#"> profile_picture/album</a>
       </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>userid ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
        <li>pic(send image) ,</li>
        <li>caption ,</li>
        <li>album_type(if verified then send 3 else blank value) ,</li>
        <li>album_id(for edit verified image)</li>
     </ul>
    </div>
    </div>
   <div class="col-sm-6">
        <div class="webserive">
      <h3>8. Private Album list</h3>
       <p><span>Link:</span><a href="#"> member_album</a>
      </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>userid ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
        <li>received_album (when call this api from received album section then send value)</li>
     </ul>
    </div>
    </div>
 </div>

<div class="row">
    <div class="col-sm-6">
        <div class="webserive">
      <h3>9. Delete Private Album Images</h3>
       <p><span>Link:</span>
       <a href="#">delete_album_picture</a>
       </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>pic_id(for multiple delete send comma separated id e.g 1,2,3 )</li>
     </ul>
    </div>
    </div>
   <div class="col-sm-6">
        <div class="webserive">
      <h3>10. Logout</h3>
       <p><span>Link:</span><a href="#"> logout</a>
      </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
     </ul>
    </div>
    </div>
 </div>

<div class="row" style="margin-bottom:10px;">
    <div class="col-sm-6">
        <div class="webserive">
      <h3>11. Create And Edit Looking Sex Profile </h3>
       <p><span>Link:</span>
       <a href="#"> add_looking_sex</a>
       </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>start_time ,</li>
        <li>end_time ,</li>
        <li>profile_name ,</li>
        <li>my_physical_appearance ,</li>
        <li>his_physical_appearance ,</li>
        <li>my_sextual_preferences ,</li>
        <li>his_sextual_preferences ,</li>
        <li>my_social_habits ,</li>
        <li>his_social_habits ,</li>
        <li>description ,</li>
        <li>duration ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
        <li>type(send type = edit for edit profile else blank)</li>

     </ul>
    </div>
    </div>


<div class="col-sm-6">
        <div class="webserive">
      <h3>12. Looking Sex Profile Details </h3>
       <p><span>Link:</span>
       <a href="#"> view_looking_sex</a>
       </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
     </ul>
    </div>
    </div>
</div>


<div class="row">
<div class="col-sm-6">
        <div class="webserive">
      <h3>13. Create And Edit Dating Profile</h3>
       <p><span>Link:</span><a href="#"> add_looking_date</a>
      </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id</li>
        <li>my_traits ,</li>
        <li>his_traits ,</li>
        <li>profile_name ,</li>
        <li>my_interest ,</li>
        <li>my_physical_appearance ,</li>
        <li>his_physical_appearance ,</li>
        <li>my_sextual_preferences ,</li>
        <li>his_sextual_preferences ,</li>
        <li>my_social_habits ,</li>
        <li>his_social_habits ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
        <li>type(send type = edit for edit profile else blank)</li>
     </ul>
    </div>
    </div>
<div class="col-sm-6">
    <div class="webserive">
      <h3>14. Dating Profile Details</h3>
       <p><span>Link:</span><a href="#"> view_looking_date</a>
      </p>
       <p><span>Fields:</span></p>
     <ul class="fields">
        <li>user_id ,</li>
        <li>current_date(format gmt [yyyy-mm-dd H:i:s]) </li>
     </ul>
    </div>
 </div>
</div>

<div class="row">
    <div class="col-sm-6">
              <div class="webserive">
            <h3>15. Move To Archive (Private Album Images)</h3>
             <p><span>Link:</span><a href="#"> move_archive</a>
            </p>
             <p><span>Fields:</span></p>
           <ul class="fields">
              <li>id(Image id) ,</li>
              <li>user_id ,</li>
              <li>current_date(format gmt [yyyy-mm-dd H:i:s]) </li>
           </ul>
          </div>
    </div>
    <div class="col-sm-6">
        <div class="webserive">
          <h3>16. Archive List</h3>
           <p><span>Link:</span><a href="#"> view_archive</a>
          </p>
           <p><span>Fields:</span></p>
         <ul class="fields">
            <li>user_id ,</li>
            <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
         </ul>
        </div>
     </div>

 </div>

<div class="row">

    <div class="col-sm-6">
        <div class="webserive">
          <h3>17. Delete Archive Images</h3>
           <p><span>Link:</span><a href="#"> delete_archive</a>
          </p>
           <p><span>Fields:</span></p>
         <ul class="fields">
            <li>id (for multiple delete send comma separated id e.g 1,2,3 )</li>
         </ul>
      </div>
    </div>


    <div class="col-sm-6">
        <div class="webserive">
          <h3>18. Share And Unshare Album</h3>
          <p><span>Link:</span><a href="#"> share_album</a></p>
          <p><span>Fields:</span></p>
          <ul class="fields">
            <li>user_id (current login user id) ,</li>
            <li>sender_id (current login user id) ,</li>
            <li>receiver_id (receiver album user id) ,</li>
            <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
          </ul>
        </div>
    </div>
 </div>


 <div class="row">

     <div class="col-sm-6">
         <div class="webserive">
           <h3>19. Rreceive Album List</h3>
           <p><span>Link:</span><a href="#"> view_receive_album</a></p>
           <p><span>Fields:</span></p>
           <ul class="fields">
             <li>user_id ,</li>
             <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
           </ul>
         </div>
     </div>

     <div class="col-sm-6">
        <div class="webserive">
          <h3>20. Album Access List</h3>
           <p><span>Link:</span><a href="#"> manage_album_access</a>
          </p>
           <p><span>Fields:</span></p>
         <ul class="fields">
            <li>user_id ,</li>
            <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
         </ul>
      </div>
     </div>

  </div>

  <div class="row">

      <div class="col-sm-6">
         <div class="webserive">
           <h3>21. Delete Album Access</h3>
            <p><span>Link:</span><a href="#"> delete_album_access</a>
           </p>
            <p><span>Fields:</span></p>
          <ul class="fields">
             <li>user_id , </li>
             <li>id  (receiver id) ,</li>
             <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
          </ul>
       </div>
      </div>

      <div class="col-sm-6">
         <div class="webserive">
           <h3>22. Rename Dating Profile</h3>
            <p><span>Link:</span><a href="#"> rename_profile_lookingdates</a>
           </p>
            <p><span>Fields:</span></p>
            <ul class="fields">
               <li>id (profile id) , </li>
               <li>profile_name </li>
            </ul>
       </div>
      </div>

   </div>

   <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>23. Rename Looking Sex Profile</h3>
             <p><span>Link:</span><a href="#"> rename_profile_lookingsex</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>id (profile id) , </li>
                <li>profile_name </li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>24. Dating Matches Grid</h3>
             <p><span>Link:</span><a href="#"> use_profile_lookdates</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>id (profile id) , </li>
                <li>user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
      <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>25. Looking Matches Grid</h3>
             <p><span>Link:</span><a href="#"> use_profile_looksex</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>id (profile id) , </li>
                <li>user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>26. Favourite And Unfavaorite</h3>
             <p><span>Link:</span><a href="#"> add_favourite_screen</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>favourite_user_id (which user I want to make favourite) ,</li>
                <li>browse(browse,looking,date['view favourite from which section']) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
      
      <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>27. Favourite Grid List</h3>
             <p><span>Link:</span><a href="#"> view_favourite_screen</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>browse(browse,looking,date['view favourite from which section']) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
                <li>last_login(for filter ) ,</li>
                <li>mutual_favorites(for filter use only) ,</li>
                <li>recently_added(for filter use only) ,</li>
                <li>search_value (for filter use only) ,</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>28. Details Profile</h3>
             <p><span>Link:</span><a href="#"> view_profile_details</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>viewer_user_id (whose profile view) ,</li>
                <li>type(browse,looking_sex,looking_date) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
          <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>29. Add And Edit Note</h3>
             <p><span>Link:</span><a href="#"> add_note</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>note_user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
                <li>note</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>30. Viewers</h3>
             <p><span>Link:</span><a href="#"> profile_viewers_details</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
              <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>31. Viewed</h3>
             <p><span>Link:</span><a href="#"> profile_viewed_details</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>32. Unshare All Album Access</h3>
             <p><span>Link:</span><a href="#"> unshare_all_album_access</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
                   <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>33. Rename Archive Images Caption</h3>
             <p><span>Link:</span><a href="#"> profile_viewed_details</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>pic_id</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>34. Move Archive To Private</h3>
             <p><span>Link:</span><a href="#"> move_archive_to_private</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>id (pic id) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
                       <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>35. Details Profile Share Unshare</h3>
             <p><span>Link:</span><a href="#"> lock_unlock_details_profile</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id ,</li>
                <li>lock_user_id ,</li>
                <li>browse(browse,dating,looking) ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>36. Add Recent Images(Chat Section)</h3>
             <p><span>Link:</span><a href="#"> add_recent_image</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>image ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
                                              <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>37. View Recent Images(Chat Section)</h3>
             <p><span>Link:</span><a href="#"> view_recent_image</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>38. Add Phrase(Chat Section)</h3>
             <p><span>Link:</span><a href="#"> add_phrases</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (current login user id) ,</li>
                <li>phrases ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>

    </div>
                                                <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>39. View Phrase(Chat Section)</h3>
             <p><span>Link:</span><a href="#"> view_phrases</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>40. Delete Phrase(Chat Section)</h3>
             <p><span>Link:</span><a href="#"> delete_phrases</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>id (phrase id) </li>
             </ul>
        </div>
       </div>

    </div>
  <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>41. Add Chat User(Chat Section)</h3>
             <p><span>Link:</span><a href="#"> add_chat_user</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id ,</li>
                <li>chat_user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s])</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>42. Message Grid</h3>
             <p><span>Link:</span><a href="#"> view_chat_users</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id ,</li>
                <li>lock_user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
                <li>browse (browse,dating,looking) ,</li>
                <li>favourite (for filter),</li>
                <li>sent_invite (for filter),</li>
                <li>received_invite (for filter),</li>
                <li>search_value (for filter),</li>
                <li>unread (for filter)</li>
             </ul>
        </div>
       </div>

    </div>
  <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>43. Forgot Password</h3>
             <p><span>Link:</span><a href="#"> lostPassword</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>email </li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>44. Save Filter Value</h3>
             <p><span>Link:</span><a href="#"> save_filter_cache</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
                 <li>type (browse,dating,looking),</li>
                <li>enable_filters (0=>off 1=>on) ,</li>
                <li>online </li>
                <li>match ,</li>
                <li>user_photos ,</li>
                <li>his_identities ,</li>
                <li>his_seeking ,</li>
                <li>ethnicity ,</li>
                <li>relationship_status ,</li>
                <li>age ,</li>
                <li>height ,</li>
                <li>weight ,</li>
                <li>list_array ,</li>
             </ul>
        </div>
       </div>

    </div>

  <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>45. Search</h3>
             <p><span>Link:</span><a href="#"> matches_filter</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
               <li>user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
                 <li>type (browse,dating,looking) ,</li>
                 <li>search_value ,</li>
                 <li>his_identitie ,(commma separated value for multiple)</li>
                 <li>his_seeking ,</li>
                 <li>ethnicity ,</li>
                 <li>relationship_status ,</li>
                 <li>profile_pic_type (1=>face pic 2=>verified photo),</li>
                 <li>age_to ,</li>
                 <li>age_from ,</li>
                 <li>match (asc and desc),</li>
                 <li>height_cm_to ,</li>
                 <li>height_cm_from ,</li>
                 <li>Weight_kg_to ,</li>
                 <li>Weight_kg_from ,</li>
                 <li>recently_email (send comma separated  email without space from quick blox for filter online section (send email recently , online and all guys)  )</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>46. Add Flag</h3>
             <p><span>Link:</span><a href="#"> add_flag</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>sender_id ,</li>
                <li>receiver_id ,</li>
                <li>flag  ,</li>
             </ul>
        </div>
       </div>

    </div>
  <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>47. Block Chat User</h3>
             <p><span>Link:</span><a href="#"> block_chat_user</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
               <li>user_id (login user id),</li>
               <li>block_user_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>48. Time Extend Looksex Profile</h3>
             <p><span>Link:</span><a href="#"> time_extend_looksex_profile</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id) ,</li>
                <li>id (looksex profile id),</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>

    </div>
    <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>49. Chat Message Push Notification</h3>
             <p><span>Link:</span><a href="#"> chat_message_push_notification</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
               <li>sender_id (login user id),</li>
               <li>receiver_id ,</li>
               <li>message ,</li>
               <li>browse ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>50. Sent Invitation</h3>
             <p><span>Link:</span><a href="#"> sent_invitation</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>sender_id (login user id) ,</li>
                <li>receiver_id ,</li>
                <li>accept (for accept invitation send 1),</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>

    </div>
        <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>51. Declain Invitation</h3>
             <p><span>Link:</span><a href="#"> declain_invitation</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
               <li>sender_id (login user id),</li>
               <li>receiver_id ,</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>52. Block Unblock User</h3>
             <p><span>Link:</span><a href="#"> block_user</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id) ,</li>
                <li>blocked_id ,</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>

    </div>
        <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>53. Stop Current Search</h3>
             <p><span>Link:</span><a href="#"> stop_current_search</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
               <li>user_id (login user id),</li>
               <li>id (looksex profile id) ,</li>
              <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>54. Payment Success</h3>
             <p><span>Link:</span><a href="#"> payment_success</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id) ,</li>
                <li>payment_for (Payment for subscription or remove add[1=>subscription 2=>removeadd]) ,</li>
                <li>amount ,</li>
                <li>month (pay for how many month),</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>

    </div>
        <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>55. Setting</h3>
             <p><span>Link:</span><a href="#"> stop_current_search</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
               <li>user_id (login user id),</li>
              <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>56. Verify Apple Purchase(IOS)</h3>
             <p><span>Link:</span><a href="#"> verify_apple_purchase</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>apple_app_product_id ,</li>
                <li>apple_app_bundle_id ,</li>
                <li>purchase_receipt_data ,</li>
                <li>user_id (login user id),</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>

    </div>
                <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>57. support</h3>
             <p><span>Link:</span><a href="#"> support</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
               <li>user_id (login user id),</li>
               <li>phone ,</li>
               <li>name ,</li>
               <li>details ,</li>
              <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>58. My Profile</h3>
             <p><span>Link:</span><a href="#"> my_profile</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id),</li>
             </ul>
        </div>
       </div>

    </div>
                <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>59. Edit Profile</h3>
             <p><span>Link:</span><a href="#"> edit_profile</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
              <li>user_id (login user id),</li>
              <li>screen_name ,</li>
              <li>email ,</li>
              <li>birthday ,</li>
              <li>identity ,</li>
               <li>ethnicity ,</li>
               <li>height ,</li>
               <li>height_cm ,</li>
               <li>weight ,</li>
               <li>Weight_kg ,</li>
               <li>about_me ,</li>
               <li>his_identitie ,</li>
               <li>relationship_status ,</li>
               <li>where_I_leave ,</li>
               <li>facebook_link ,</li>
               <li>twitter_link ,</li>
               <li>linkedin_link </li>
              
           </ul>
        </div>
       </div>
       <div class="col-sm-6">
          <div class="webserive">
            <h3>60. Change Password</h3>
             <p><span>Link:</span><a href="#"> change_password</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id),</li>
                <li>password ,</li>
             </ul>
        </div>
       </div>

    </div>
                <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>61. Blocked User List(setting page)</h3>
             <p><span>Link:</span><a href="#"> blocked_user_list</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
              <li>user_id (login user id),</li>
               <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
              
           </ul>
        </div>
       </div>
      <div class="col-sm-6">
          <div class="webserive">
            <h3>62. Unblock All(setting page)</h3>
             <p><span>Link:</span><a href="#"> unblock_all_users</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id),</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>

    </div>
                <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>63. Read All Message(setting page)</h3>
             <p><span>Link:</span><a href="#"> read_all_message</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
              <li>user_id (login user id),</li>
               <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
              
           </ul>
        </div>
       </div>
      <div class="col-sm-6">
          <div class="webserive">
            <h3>64. Lock Detail Profile(setting page)</h3>
             <p><span>Link:</span><a href="#"> lock_detail_profile</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id),</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
                <li>type(dating,looking if both then send blank) ,</li>
             </ul>
        </div>
       </div>

    </div>

    <div class="row">

       <div class="col-sm-6">
          <div class="webserive">
            <h3>65. Clear All Message(setting page)</h3>
             <p><span>Link:</span><a href="#"> clear_all_message</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
              <li>user_id (login user id),</li>
               <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
              
           </ul>
        </div>
       </div>
      <div class="col-sm-6">
          <div class="webserive">
            <h3>66. Delete Profile(setting page)</h3>
             <p><span>Link:</span><a href="#"> delete_profile</a>
            </p>
             <p><span>Fields:</span></p>
             <ul class="fields">
                <li>user_id (login user id),</li>
                <li>current_date(format gmt [yyyy-mm-dd H:i:s]) ,</li>
             </ul>
        </div>
       </div>

    </div>




  
 </div>


</body>
</html>
