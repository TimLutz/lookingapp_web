function initApp()
{
  var config = {
    apiKey: "AIzaSyAzQDQ4EldRySSHdDixmUhL9trZzec4ZfI",
    authDomain: "madwalll-a5b4f.firebaseapp.com",
    databaseURL: "https://madwalll-a5b4f.firebaseio.com",
    projectId: "madwalll-a5b4f",
    storageBucket: "madwalll-a5b4f.appspot.com",
    messagingSenderId: "277872430975"
  };


  return firebase.initializeApp(config);

} 
var log=initApp();
//


//function for sending notification id user is not online from a time period



function getOnlineNotification(reference,user,message){

  var chatRef = firebase.database().ref(reference);
  chatRef.once('value', function(dataSnapshot) {
    
    
    
      
       $.ajax({
                url: path_api+'check-notification',
                type: 'GET',
                dataType: 'json',
                data: {"purpose":"chat","title":"Chat Message","message":'You have received a new message.',"user_id":user},
                beforeSend : function () {  },
                success: function(data) { 
                    
                   

                   
                },
                error: function(error) { 
                   
                               
                },
                            

                complete: function() //
                { 
                    
                }
            })

    
  });
}




//function for getting the icon of file firebase according to extension

function getIcon(ext)
{
  switch(ext){ 
    case 'image/png' :
          var icon='<i class="fa fa-file-image-o"></i>';
          break;
    case 'image/jpg' :
          var icon='<i class="fa fa-file-image-o"></i>';
          break;
    case 'image/jpeg' :
          var icon='<i class="fa fa-file-image-o"></i>';
          break;
    case 'video/mp4' :
          var icon='<i class="fa fa-file-video-o"></i>';
    case 'audio/mp3' :
          var icon='<i class="fa fa-music"></i>';

          break;
    default : 
          var icon='<i class="fa fa-file-o"></i>';

  }
  return icon;
  
}







//getiing the detail of a firebase chat of a given reference 


function getChat(reference,key)
{

  
  var chatRef = firebase.database().ref(reference);
  
  //running on chat message is added to the firebase database
  $(".candiate-chat-msg-list").html('');
  
  var message_c=0;

  chatRef.once('value', function(dataSnapshot) {
    
    
    var message_obj=dataSnapshot.val();
    
    if(message_obj!=null)
    {

      var msgCount = Object.keys(message_obj).length;
      var count = 1;
      Object.keys(message_obj).forEach(function(key) {
        
        chatRef.child(key).update({read:true});
        if($('#'+key).length){
          //return;
          $('#'+key).remove();
        }
        //increasing the count of unread messages
        if(!message_obj[key].read && message_obj[key].sender != employer)
        {
          
          message_c++;
        }
        
        var date = new Date(message_obj[key].createdAt);
        //console.log(date.getHours()+':'+date.getMinutes());
        var Div_class=moment(message_obj[key].createdAt).format('DDMMYYYY');
        if($(".candiate-chat-msg-list").find('.'+Div_class).length) {
          var date_div='';

        } else {

          if($('.dateDiv').last().attr('class') && moment($('.dateDiv').last().attr('class').split(' ')[1], 'DDMMYYYY') > moment(message_obj[key].createdAt)){
            $(".candiate-chat-msg-list").prepend('<div class="clearfix"></div><div class="dateDiv '+Div_class+'"></div>');
          }else{
            $(".candiate-chat-msg-list").append('<div class="clearfix"></div><div class="dateDiv '+Div_class+'"></div>');
          }
          
          var date_div='<div class="clearfix"></div><div class="chatDatetime">'+moment(message_obj[key].createdAt).format('dddd D  MMM')+'</div><div class="clearfix"></div>';

        }


        //if class exist then append to it
        if(message_obj[key].sender==employer)
        {
          var class_msg ="chat-msg-send "+key;
          //$(".candiate-chat-msg-list").find('.'+Div_class).append();
        }
        else{
          var class_msg ="chat-msg-recive "+key;
        }

        
        if(message_obj[key].media){
            switch(message_obj[key].type)
            {
              case 'video/mp4':
              var play_button = '<span title="Preview" data-type="'+message_obj[key].type+'" class="file_type_firebase"><i class="fa fa-file-video-o"></i></span>';
              break;
              case 'audio/mp3':
              var play_button = '<span title="Preview" data-type="'+message_obj[key].type+'" class="file_type_firebase"><i class="fa fa-music"></i></span>';
              break;
              case 'image/png':
              case 'image/gif':
              case 'image/jpeg':
              case 'image/jpg':
              var play_button = '<span title="Preview" data-type="'+message_obj[key].type+'" class="file_type_firebase"><i class="fa fa-file-image-o"></i></span>';
              break;
              default:
              var play_button = '<span title="Preview" data-type="'+message_obj[key].type+'" class="file_type_firebase"><i class="fa fa-file-o"></i></span>';
            }

            var upload_class='upload_div';
            var download_link='<a target="_blank" href="'+message_bag.download+'" download><span class="msgfiledownload"><i class="fa fa-download"></i> '+lang[language].download+'</span></a>';
            var size_div='<span class="file_size">'+message_bag.size+' kb</span>';
            var icon_div=getIcon(message_bag.type);

            var html='<div id='+key+' class="'+class_msg+' '+upload_class+'"><div style="color: #40B76A;display: inline-block;font-size: 50px;line-height: 20px;cursor:pointer;">'+play_button+'</div><div class="download_sizeM">'+download_link+'</div><span class="chatTime">'+moment(message_obj[key].createdAt).format('LT')+'</span></div>';
        }
        else{
          var upload_class='';
          var download_link='';
          var size_div='';
          var icon_div='';
          var play_button='';
          var html='<div id='+key+' class="'+class_msg+' '+upload_class+'">'+message_obj[key].message+' <div class="download_sizeM">'+icon_div+' '+size_div+' '+play_button+' '+download_link+'</div> <span class="chatTime">'+moment(message_obj[key].createdAt).format('LT')+'</span></div>';
  
        }

        $(".candiate-chat-msg-list").find('.'+Div_class).append(date_div+html); 
        //appends ends here
        console.log(msgCount+' - '+count);
        if(count == msgCount){
          $('.candiate-chat-msg-loader').removeClass('active');
          console.log('scroller run here get chat'); 
          $(".candiate-chat-msg-list").animate({ scrollTop: $(".candiate-chat-msg-list")[0].scrollHeight}, 1000);
          //$(".candiate-chat-msg-list").scrollTop($(".candiate-chat-msg-list")[0].scrollHeight());
        }
        count++;
    })
    }
    
  });
}


//function for mark chat as read






function createStorage(name)
{
    var sessionsRef = firebase.database().ref(name);
    sessionsRef.push();
    console.log(name);
    console.log('called');
   
} 

//function for uploading files to the firebase server

function createFileReference(reference,attch_file,sender,reciever,add_reference){
  var storageRef = firebase.storage().ref('documents');

  var name=Date.now();
  
  var storageRef2 = firebase.storage().ref('documents/'+attch_file.name);
  var metadata = {
      contentType: attch_file.type,
  };

  var uploadTask = storageRef2.put(attch_file, metadata);
  uploadTask.then(function(snapshot) {
    if(add_reference){
      createMediaMessage(reference+'/'+add_reference,sender,reciever,attch_file.name,snapshot.downloadURL,attch_file.type,attch_file.size);
      console.log('has file and application');

    }else{
      createMediaMessage(reference+'/one_to_one',sender,reciever,attch_file.name,snapshot.downloadURL,attch_file.type,attch_file.size);
      console.log('has file and not application');
      
    }
    
  });

}




//delete a file from firebase

function deleteRefrence(reference)
{
  var desertRef = storageRef.child(reference);

  // Delete the file
  desertRef.delete().then(function() {
    return true;
  }).catch(function(error) {
    return false;
  });
}



//function for creating a message to a reference

function createMessage(reference,msg,sender,reciever)
{
    var createmessageref = firebase.database().ref(reference);
    
    //Creating json for sending to firebase
    var send_json={ 
                    sender:sender,
                    reciever:reciever,
                    message: msg,
                    read:false,
                    media: false, // added by Sahil
                    createdAt: firebase.database.ServerValue.TIMESTAMP,
                    updateAt: firebase.database.ServerValue.TIMESTAMP 
                  }
     createmessageref.push(send_json);
    //mySessionRef.update(send_json);
    
}

function createOnlineMessage(reference)
{
    var createmessageref = firebase.database().ref(reference);
    
    //Creating json for sending to firebase
    var send_json={ 
                    
                    last_online: firebase.database.ServerValue.TIMESTAMP
                    
                  }
     createmessageref.push(send_json);
     console.log('create message online run');
     console.log(reference);
    //mySessionRef.update(send_json);
    
}

function createMediaMessage(reference,sender,reciever,name,download,filetype,size)
{
    var createmessageref = firebase.database().ref(reference);
    var size_mb=parseFloat((size/1024).toFixed(2));

    //Creating json for sending to firebase
    var send_json={ 
                    sender:sender,
                    reciever:reciever,
                    message: name,
                    read:false,
                    media:true,
                    type:filetype,
                    size:size_mb,
                    name:name,
                    download:download,
                    createdAt: firebase.database.ServerValue.TIMESTAMP,
                    updateAt: firebase.database.ServerValue.TIMESTAMP 
                  }

console.log(send_json);

  createmessageref.push(send_json);
    //mySessionRef.update(send_json);
    
}

//function for removing a reference 

function removeChat(refrence,key)
{
  var adaRef = firebase.database().ref(refrence);
  adaRef.remove()
  .then(function() {
    $(".candiate-chat-msg-list").html('');
    $('li#'+key).find('.chatcounteach').css("display","none");
  })
  .catch(function(error) {
    console.log("Remove failed: " + error.message)
  });
}




//Function for craeting user on firebase

function createUserFirebase(email,pass)
{
  firebase.auth().createUserWithEmailAndPassword(email, pass).then(function(result) {

    console.log('user created');
  }).catch(function(error) {
  // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
  // [START_EXCLUDE]
    if (errorCode == 'auth/weak-password') {
      alert('The password is too weak.');
    } else {
      alert(errorMessage);
    }
    console.log(error);
  // [END_EXCLUDE]
  }); 
}

//Function for logout the user from firebase

function logoutFirebase()
{
    firebase.auth().signOut();
}


//Function for check a user is login or logout on firebase function will return true if login otherwise false;

function chackAvailability()
{
  firebase.auth().onAuthStateChanged(function(user) {
    if(user===null)
    {
      
      return true;
    }
    else{
      
      return false;
    }
  });
}



//function for login a user on firebase

function loginFirebase(email,password)
{
  firebase.auth().signInWithEmailAndPassword(email, password).then(function(result) {
    
    console.log('login success');

  }).catch(function(error) {
  // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    // [START_EXCLUDE]
    if (errorCode === 'auth/wrong-password') {
      console.log('Firebase login failed');
    } else {
      console.log(errorMessage);
    }
    
    if(firebase.auth().currentUser)
    {
      console.log('login failed');
    }

  // [END_EXCLUDE]
  });
}
