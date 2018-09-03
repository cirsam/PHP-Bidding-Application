(function()
{

    bidnow = function(id)
    {
        var results = {};
        var bidamount = $("#bidamount_"+id);
        var bidstatus = $("#bidstatus_"+id);
        var numofbids = $("#numofbids_"+id+" strong");

        $.post("/Controllers/Bids/Addbids.php",{bidamount:bidamount.val(),id:id},function(response){            
            results = JSON.parse(response);
            if(results.status==="OK")
            {
                numofbids.text(results.totalbids);
                bidamount.val(null);
                bidstatus.html("<span style=\"color:green;\" >Great your bid has been placed</span>");
            }
            else
            {
                bidstatus.html("<span style=\"color:red;\" >"+results.msg+"</span>");
            }
        });
    }

   register = function()
   {
       window.location.href = "/html/register.php";
   };

   login = function()
   {
       window.location.href = "/html/login.php";
   };

   signout = function()
   {
       window.location.href = "/Auth/Logout.php";
   };

   info = function()
   {
       window.location.href = "/html/profile.php";
   };
})();