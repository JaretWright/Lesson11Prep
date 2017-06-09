/**
 * Created by JWright on 5/26/2017.
 */

//use jQuery for a Delete confirmation pop-up
$('.confirmation').on('click', function(){
    return confirm('Are you sure you want to delete this item?');
});