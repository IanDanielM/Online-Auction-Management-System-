<!-- session time left
table for participated bidders
leave bid
after bid ends info of the winner is shown and bid ranking
bid
-->
<html>
<head>
<?php
include('dbh.inc.php');
if($_SERVER['REQUEST_METHOD'] == "POST") {

}
?>
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<title>Start Page</title>
<link rel="stylesheet" href="main.css">	
</style>
</head>
<body>
<?php
session_start();
if(isset($_GET['prod_id'])){
$qry = $conn->query("select * from products where prod_id= ".$_GET['prod_id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
$cat_qry = $conn->query("select * from categories where id = $prod_category");

}

?>
<style type="text/css">
	#bid-frm{
		display: none
	}
	.broom{
		width: 300px;
		border: 2px solid var(--clr-green-dark);
		margin-left: 15px;
		margin-top: 20px;
	} 
	.flex{
		display: flex;
		align-items: center;
		justify-content: center;
		margin-left: 15px;
		
	}
	.bidrank{
margin-top: 20px;
    width: 250px;
	display: flex;
		align-items: center;
        border: 2px solid var(--clr-green-dark);
	}
	.bid1{
		
	}
	.bid2{

	}
	.bid1 img{
		width: 80px;
		height: 80px;
	}
	#bidz{
		display: none;
	}
	
</style>
<h3 style="text-align: center;">Session Time Left</h3>
	<h3 style="text-align: center; color:var( --clr-red-dark);" id="demo"></h3>
	<div id="bidz">
	<?php
$bids="select * from bids inner join users on bids.user_id=users.user_id where product_id=$prod_id order by bid_amount desc limit 1";
$run_bid=mysqli_query($conn,$bids);
while($dataz=mysqli_fetch_array($run_bid)){
	?>

<MARQUee><h2>THE  HIGHEST BIDDER IS:<?php echo $dataz['f_name'] ?></H2></MARQUee>
<?php
}

?>
</div>
	<div class="tab">

	

<div class="broom">
	
	<img src="./seller/products/<?php echo $prod_img ?>" class="ren" width="150px" height="150px"  alt="">
	<p style="margin-bottom: 0; margin-left:5px;">Name: <large><b><?php echo $prod_name ?></b></large></p>
	<p  style="margin-bottom: 0; margin-left:5px;">Starting Amount: <b id="hbid"><?php echo number_format($minimum_price,2) ?></b></p>
	<div class="col-md-12">
		<button style="margin-left:40px; border-color:var(--clr-grey-1);" class="btn" type="button" id="bid">Bid</button>
	</div>
	<div id="bid-frm">
		<div>
			<form id="manage-bid">
				<input type="hidden" name="product_id" value="<?php echo $prod_id ?>">
				<div >
					<label for="">Bid Amount:</label>
					<input id="rum" type="number"  name="bid_amount" >
				</div>
				<div style="margin:10px;">
					<button style="margin-left:10px; border-color:var(--clr-green-dark);"  class="btn">Submit</button>
					<button style="margin-left:25px;  border-color:var(--clr-red-dark);" type="button" class="btn" id="cancel_bid">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<h3 style="text-align: center;">Top 3 BIDS Submitted</h3>
<?php
$bids="select * from bids inner join users on bids.user_id=users.user_id where product_id=$prod_id order by bid_amount desc limit 3";
$run_bid=mysqli_query($conn,$bids);
while($data=mysqli_fetch_array($run_bid)){
	?>
	<div class="flex">
	<div class="bidrank">
		<div class="bid1">
	<img src="profiles/<?php echo $data['user_img'] ?>" height="150px" alt="">
	</div>
	<div class="bid2">
	<p>bidder name:<?php echo $data['f_name'] ?></p>
	<p>phoneno:<?php echo $data['phoneno'] ?></p>
	<p>bid sumbit:<?php echo $data['bid_amount'] ?></p>
	</div>
	</div>

<?php
}
?>
</div>
</div>



<script>
    var _updateBid = setInterval(function(){
    	$.ajax({
    		url:'ajax.php?action=get_latest_bid',
    		method:'POST',
    		data:{product_id:'<?php echo $prod_id ?>'},
    		success:function(resp){
    			if(resp && resp > 0){
    				$('#hbid').text(parseFloat(resp).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
    			}
    		}
    	})
    },1000)

    $('#manage-bid').submit(function(e){
    	e.preventDefault()
           
            var latest = $('#hbid').text()
            latest = latest.replace(/,/g,'')
            if(parseFloat(latest)  > $('[name="bid_amount"]').val()){
            	alert("Bid amount must be greater than the current Highest Bid.",'danger')
            
            	return false;
            }
			
            $.ajax({
                url:'ajax.php?action=save_bid',
                method:'POST',
                data:$(this).serialize(),
                success:function(resp){
                    if(resp==1){
                        alert("Bid successfully submited",'success')
            			
                    }else if(resp==2){
                    	alert("The current highest bid is yours.",'danger')
            			
                    }
                }
            })
        })
    $('#bid').click(function(){
    	$('#bid-frm').show()
    })
    $('#cancel_bid').click(function(){
    	$('#bid').show()
    	$('#bid-frm').hide()
    })
</script>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $session_date ?>").getTime();
// Update the count down every 1 second

var x = setInterval(function() {
// Get today's date and time
var now = new Date().getTime();
// Find the distance between now and the count down date
var distance = countDownDate - now;
// Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "BID NO LONGER AVAILABLE";
    document.getElementById('bidz').style.display = "block";
     
  }
}, 1000);

</script>
</body>
</html>