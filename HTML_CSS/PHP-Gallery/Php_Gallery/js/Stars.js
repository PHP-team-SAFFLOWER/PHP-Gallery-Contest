/**
 * Created by lion on 26.8.2014 г..
 */
function stars(){
    var star1 = document.getElementById('star1').value;
    var star2 = document.getElementById('star2').value;
    var star3 = document.getElementById('star3').value;
    var star4 = document.getElementById('star4)').value;
    var star5 = document.getElementById('star5').value;

    console.log(star1);
    if(star1==1){
        document.getElementById('star2').backgroundImage = "url('../IMAGES/star_dark.png')";

    }
}