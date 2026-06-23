function login() {
    setTimeout(() => {
        document.getElementById('welcome').style.display = 'none';
        document.getElementById('pra4').style.display = 'block';
        document.getElementById('pra5').style.display = 'none';
        document.getElementById('pra10').style.display = 'none';
    }, 2000);
}
function signup() {
    setTimeout(() => {
        document.getElementById('welcome').style.display = 'none';
        document.getElementById('pra4').style.display = 'none';
        document.getElementById('pra5').style.display = 'block';
        document.getElementById('pra10').style.display = 'none';
    }, 2000);
}


function display() {
    document.getElementById("pra18").style.display = "block";
    document.getElementById("pra20").style.display = "none";

}



function validation(){
            for(let i = 1; i <= 9; i++) {
                let msgElement = document.getElementById("msg" + i);
                if(msgElement) {
                    msgElement.style.display = "none";
                }
            }
            let a=document.getElementsByName('sfname')[0].value;
            let j=document.getElementsByName('smname')[0].value;
            let b=document.getElementsByName('slname')[0].value;
            let d=document.getElementsByName('smobile')[0].value;
            let e=document.getElementsByName('saddress')[0].value;
            let fa=document.getElementsByName('suname')[0].value;
            let fb=document.getElementsByName('semail')[0].value;
            let rval = document.querySelector('input[name="sgender"]:checked'); 
            let g=document.getElementsByName('spwd')[0].value;
            let h=document.getElementsByName('spwd1')[0] ? document.getElementsByName('spwd')[0].value : g;
            let i=document.querySelector('input[name="sterms"]:checked');
            //firstname Validation logic
            if(a===""){
                document.getElementById("msg1").innerText="First name must be more than 2 character consisting only alphabets";
                document.getElementById("msg1").style.color="red";
                document.getElementById("msg1").style.display="block";
                return false;
            }
            if(!a.match(/^[a-zA-Z]{3,}$/)){
                document.getElementById('msg1').innerText="First name must be more than 2 character consisting only alphabets";
                document.getElementById('msg1').style.color="red";
                document.getElementById('msg1').style.display="block";
                return false;
            }
            //middle name validation
            if(j!=="" && !j.match(/^[a-zA-Z]{3,}$/)){
                document.getElementById('msg2').innerText="Middle name must be more than 2 character consisting only alphabets";
                document.getElementById('msg2').style.color="red";
                document.getElementById('msg2').style.display="block";
                return false;
            }
            //last name validation
            if(b===""){
                document.getElementById("msg3").innerText="Last name must be more than 2 character consisting only alphabets";
                document.getElementById("msg3").style.color="red";
                document.getElementById("msg3").style.display="block";
                return false;
            }
            if(!b.match(/^[a-zA-Z]{3,}$/)){
                document.getElementById("msg3").innerText="Last name must be more than 2 character consisting only alphabets";
                document.getElementById("msg3").style.color="red";
                document.getElementById("msg3").style.display="block";
                return false;
            }
            //gender Validation
            if(rval==null){
                alert("Please select the gender");
                return false;
            }
            //mobile no validation
            if(d===""){
                document.getElementById("msg4").innerText="This field cannot be empty please enter your valid phone number";
                document.getElementById("msg4").style.color="red";
                document.getElementById("msg4").style.display="block";
                return false;
            }
            if(isNaN(d)){
                document.getElementById("msg4").innerText="Mobile number cannot contain other characters than digits.";
                document.getElementById("msg4").style.color="red";
                document.getElementById("msg4").style.display="block";
                return false;
            }
            if(!(d.startsWith('98') || d.startsWith('97'))){
                document.getElementById("msg4").innerText="Mobile number always should start with 98 or 97";
                document.getElementById("msg4").style.color="red";
                document.getElementById("msg4").style.display="block";
                return false;
            }
            if(d.length !==10){
                document.getElementById("msg4").innerText="Mobile number must be of length of 10 digits.";
                document.getElementById("msg4").style.color="red";
                document.getElementById("msg4").style.display="block";
                return false;
            }
            //Address validation  
            if(e===""){
                document.getElementById("msg5").innerText="This field cannot be empty please enter your valid address";
                document.getElementById("msg5").style.color="red";
                document.getElementById("msg5").style.display="block";
                return false;
            }
            if(!e.match(/^[A-Za-z]{4,15}-\d{1,2} [A-Za-z]{2,15},[ ]?[nN]epal$/)){
                document.getElementById("msg5").innerText="please match the pattern [chainpur-1 chitwan,nepal]";
                document.getElementById("msg5").style.color="red";
                document.getElementById("msg5").style.display="block";
                return false;
            }
            //Username Validation      
            if(fa==""){
                document.getElementById("msg6").innerText="This field cannot be empty please enter your username";
                document.getElementById("msg6").style.color="red";
                document.getElementById("msg6").style.display="block";
                return false;
            }
            if(fa.length<=4){
                document.getElementById("msg6").innerText="Username must be of more than 4 character.";
                document.getElementById("msg6").style.color="red";
                document.getElementById("msg6").style.display="block";
                return false;
            }
            //Email Validation
            if(fb===""){
                document.getElementById("msg7").innerText="This field cannot be empty please enter your valid email";
                document.getElementById("msg7").style.color="red";
                document.getElementById("msg7").style.display="block";
                return false;
            }
            if(!fb.match(/^[\w.%+-]+@[\w.-]+\.[A-Za-z]{2,}$/)){
                document.getElementById("msg7").innerHTML="Your email couldn't validate. Please enter the valid Email.";
                document.getElementById("msg7").style.color="red";
                document.getElementById("msg7").style.display="block";
                return false;
            }
            // Password validation
            if(g===""){
                document.getElementById("msg8").innerHTML="This field cannot be empty please enter your password";
                document.getElementById("msg8").style.color="red";
                document.getElementById("msg8").style.display="block";
                return false;
            }
            if(g.length<=5){
                document.getElementById("msg8").innerHTML="Password must be minimum of 6 characters.";
                document.getElementById("msg8").style.color="red";
                document.getElementById("msg8").style.display="block";
                return false;
            }
            // Check confirm password if it exists
            if(document.getElementsByName('spwd')[0] && h===""){
                document.getElementById("msg9").innerHTML="This field cannot be empty please repeat the password you entered above";
                document.getElementById("msg9").style.color="red";
                document.getElementById("msg9").style.display="block";
                return false;
            }
            // Password match validation if confirm password exists
            if(document.getElementsByName('spwd1')[0] && g!==h){
                document.getElementById("msg8").innerHTML="Your password didn't match.";
                document.getElementById("msg9").innerHTML="Your password didn't match.";
                document.getElementById("msg8").style.color="red";
                document.getElementById("msg9").style.color="red";
                document.getElementById("msg8").style.display="block";
                document.getElementById("msg9").style.display="block";
                return false;
            }
            // Terms validation if it exists
            if(document.querySelector('input[name="sterms"]') && !i){
                alert("Please agree to our terms and conditions.");
                return false;
            }
            
            // If we reach here, all validations passed
            console.log("Validation passed - form will be submitted");
            return true;
        }
function validation1(){
    for(let i = 1; i <= 9; i++) {
        let msgElement = document.getElementById("msg1" + i);
        if(msgElement) {
            msgElement.style.display = "none";
        }
    }

    let a=document.getElementsByName('afname')[0].value;
    let j=document.getElementsByName('amname')[0].value;
    let b=document.getElementsByName('alname')[0].value;
    let d=document.getElementsByName('amobile')[0].value;
    let e=document.getElementsByName('aaddress')[0].value;
    let fa=document.getElementsByName('auname')[0].value;
    let fb=document.getElementsByName('aemail')[0].value;
    let rval = document.querySelector('input[name="agender"]:checked'); 
    let g=document.getElementsByName('apwd')[0].value;
    let h=document.getElementsByName('apwd1')[0] ? document.getElementsByName('apwd1')[0].value : g;
    let i=document.querySelector('input[name="aterms"]:checked');
    //firstname Validation logic
    if(a===""){
        document.getElementById("msg11").innerText="First name must be more than 2 character consisting only alphabets";
        document.getElementById("msg11").style.color="red";
        document.getElementById("msg11").style.display="block";
        return false;
    }
    if(!a.match(/^[a-zA-Z]{3,}$/)){
        document.getElementById('msg11').innerText="First name must be more than 2 character consisting only alphabets";
        document.getElementById('msg11').style.color="red";
        document.getElementById('msg11').style.display="block";
        return false;
    }
    //middle name validation
    if(j!=="" && !j.match(/^[a-zA-Z]{3,}$/)){
        document.getElementById('msg12').innerText="Middle name must be more than 2 character consisting only alphabets";
        document.getElementById('msg12').style.color="red";
        document.getElementById('msg12').style.display="block";
        return false;
    }
    //last name validation
    if(b===""){
        document.getElementById("msg13").innerText="Last name must be more than 2 character consisting only alphabets";
        document.getElementById("msg13").style.color="red";
        document.getElementById("msg13").style.display="block";
        return false;
    }
    if(!b.match(/^[a-zA-Z]{3,}$/)){
        document.getElementById("msg13").innerText="Last name must be more than 2 character consisting only alphabets";
        document.getElementById("msg13").style.color="red";
        document.getElementById("msg13").style.display="block";
        return false;
    }
    //gender Validation
    if(rval==null){
        alert("Please select the gender");
        return false;
    }
    //mobile no validation
    if(d===""){
        document.getElementById("msg14").innerText="This field cannot be empty please enter your valid phone number";
        document.getElementById("msg14").style.color="red";
        document.getElementById("msg14").style.display="block";
        return false;
    }
    if(isNaN(d)){
        document.getElementById("msg14").innerText="Mobile number cannot contain other characters than digits.";
        document.getElementById("msg14").style.color="red";
        document.getElementById("msg14").style.display="block";
        return false;
    }
    if(!(d.startsWith('98') || d.startsWith('97'))){
        document.getElementById("msg14").innerText="Mobile number always should start with 98 or 97";
        document.getElementById("msg14").style.color="red";
        document.getElementById("msg14").style.display="block";
        return false;
    }
    if(d.length !==10){
        document.getElementById("msg14").innerText="Mobile number must be of length of 10 digits.";
        document.getElementById("msg14").style.color="red";
        document.getElementById("msg14").style.display="block";
        return false;
    }
    //Address validation  
    if(e===""){
        document.getElementById("msg15").innerText="This field cannot be empty please enter your valid address";
        document.getElementById("msg15").style.color="red";
        document.getElementById("msg15").style.display="block";
        return false;
    }
    if(!e.match(/^[A-Za-z]{4,15}-\d{1,2} [A-Za-z]{2,15},[ ]?[nN]epal$/)){
        document.getElementById("msg15").innerText="please match the pattern [chainpur-1 chitwan,nepal]";
        document.getElementById("msg15").style.color="red";
        document.getElementById("msg15").style.display="block";
        return false;
    }
    //Username Validation      
    if(fa===""){
        document.getElementById("msg16").innerText="This field cannot be empty please enter your username";
        document.getElementById("msg16").style.color="red";
        document.getElementById("msg16").style.display="block";
        return false;
    }
    if(fa.length<=4){
        document.getElementById("msg16").innerText="Username must be of more than 4 character.";
        document.getElementById("msg16").style.color="red";
        document.getElementById("msg16").style.display="block";
        return false;
    }
    //Email Validation
    if(fb===""){
        document.getElementById("msg17").innerText="This field cannot be empty please enter your valid email";
        document.getElementById("msg17").style.color="red";
        document.getElementById("msg17").style.display="block";
        return false;
    }
    if(!fb.match(/^[\w.%+-]+@[\w.-]+\.[A-Za-z]{2,}$/)){
        document.getElementById("msg17").innerHTML="Your email couldn't validate. Please enter the valid Email.";
        document.getElementById("msg17").style.color="red";
        document.getElementById("msg17").style.display="block";
        return false;
    }
    // Password validation
    if(g===""){
        document.getElementById("msg18").innerHTML="This field cannot be empty please enter your password";
        document.getElementById("msg18").style.color="red";
        document.getElementById("msg18").style.display="block";
        return false;
    }
    if(g.length<=5){
        document.getElementById("msg18").innerHTML="Password must be minimum of 6 characters.";
        document.getElementById("msg18").style.color="red";
        document.getElementById("msg18").style.display="block";
        return false;
    }
    // Check confirm password if it exists
    if(document.getElementsByName('cpassword1')[0] && h===""){
        document.getElementById("msg19").innerHTML="This field cannot be empty please repeat the password you entered above";
        document.getElementById("msg19").style.color="red";
        document.getElementById("msg19").style.display="block";
        return false;
    }
    // Password match validation if confirm password exists
    if(document.getElementsByName('cpassword1')[0] && g!==h){
        document.getElementById("msg18").innerHTML="Your password didn't match.";
        document.getElementById("msg19").innerHTML="Your password didn't match.";
        document.getElementById("msg18").style.color="red";
        document.getElementById("msg19").style.color="red";
        document.getElementById("msg18").style.display="block";
        document.getElementById("msg19").style.display="block";
        return false;
    }
    // Terms validation if it exists
    if(document.querySelector('input[name="terms"]') && !i){
        alert("Please agree to our terms and conditions.");
        return false;
    }
    
    // If we reach here, all validations passed
    console.log("Validation passed - form will be submitted");
    return true;
}
