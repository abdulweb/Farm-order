<?php
session_start();
error_reporting(0);
/**
* 
*/
class user extends dbh
{
	

	
	// function __construct(argument)
	// {
	// 	# code...
	// }


	public function login($username, $password)
	{
		if($username == 'admin@admin.com' && $password == 'pass3word')
		{
			$_SESSION['user'] = $username;
			$_SESSION['usertype'] = 'superAdmin';
			$error = 0;
			header('location:admin/dashboard.php');
		}
		else{

			$hashPassword = md5($password);
			$stmt = "SELECT * from user where email = '$username' && password = '$hashPassword'";
			$result = $this->connect()->query($stmt);
			$numberrows = $result->num_rows;
			if ($numberrows > 0 ) 
			{
				$rows= $result->fetch_assoc();
				$_SESSION['user'] = $rows['email'];
				header('location:user/dashboard.php');
			}
			else
			{
				$error = 1;
				echo  $this->messages($error);
			}

		}
		
	}

	public function messages($message)
	{
		if ($message == 1) {
			return '<div class ="alert alert-danger"> Wrong username and password </div>';
		}
		if($message == 2)
		{
			return '<div class ="alert alert-danger"> Attension!!! Unthorize user </div>';
		}
		// else{
		// 	return 'success';
		// }
	}

	public function sessioncheck($sess)
	{
		if ($sess =='' or empty($sess) or $sess == null) 
		{
			header('location:..\index.php');
		}
		else{
			//return $sess;
		}
	}
	public function emptysession ($set){
		unset($set);
		header('location:..\index.php');
	}


	public function insertStaff($lastName,$otherName,$gender,$email,$phoneNo){
		if (empty($this->checkUser($email))) 
		{
			##########

			$target_dir = "uploads/";
            $target_file1 = $target_dir . basename($_FILES["passport"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
            $indigineLetterFileType = pathinfo($target_file2,PATHINFO_EXTENSION);
            $confirmationLetterFileType = pathinfo($target_file3,PATHINFO_EXTENSION);
            $check = getimagesize($_FILES["passport"]["tmp_name"]);
            if($check !== false) 
            {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else {
            	echo '<div class ="alert alert-danger"> Passport is not an image. Please select Image file ! </div>';
                $uploadOk = 0;
            }
            // check passport
            if ($_FILES["passport"]["size"] > 5000000) 
              {
                   	echo '<div class ="alert alert-danger"> Sorry, your Passport file is too large. Must not be more than 5MB </div>';
                  $uploadOk = 0;
              }

              // Allow certain file formats
             if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
              {
                   	echo '<div class ="alert alert-danger"> Sorry, only JPG, JPEG, PNG  format is allowed for Passport. </div>';
                  $uploadOk = 0;
              }
              if ($uploadOk == 0) 
              {
                    echo '<div class ="alert alert-danger"> Sorry, your file was not uploaded. Please retry. </div>';

              // if everything is ok, try to upload file
              }
          else
          {
          	if ( (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file1)) )
              	{
          		$date = date('Y-m-d');
				$insert = "INSERT INTO staff(lastName,otherName,gender,email,status,phoneNo,passport,date_create)Values('$lastName','$otherName','$gender','$email','$status','$phoneNo','$target_file1','$date')";
				$stmt = $this->connect()->query($insert);
				if (!$stmt) {
					echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
				}
				else
				{
					echo '<div class ="alert alert-success"> <strong> New Staff add Successfully </strong> </div>';
					
				}
			}
		}

			###########
			
		}
		
		else{
			echo $this->checkUser($email);
		}
	}
	

	public function checkUser($email)
	{

		$stmt = "SELECT * FROM staff where email = '$email' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! User  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function deleteStaff($id)
	{
		$stmt = "DELETE FROM staff where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Staff Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function allStaff(){
		$stmt = "SELECT * FROM staff";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function allOneStaff($id){
		$stmt = "SELECT * FROM staff where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
			if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			return $data;
		}
		else{
			return '';
		}
	}

	public function updateStaff($lastName,$otherName,$gender,$email,$phoneNo,$id){

	 $stmt = "UPDATE staff set lastName = '$lastName', otherName = '$otherName', gender ='$gender', email ='$email', phoneNo = '$phoneNo' where id = '$id'";
	 $result = $this->connect()->query($stmt);
	 if($result)
	 {
	 	echo '<div class ="alert alert-success"> <strong> Record Update Successfully </strong> </div>';
	 }
	 else{
	 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

	 }

	}

	public function allcategory(){
		$stmt = "SELECT * FROM categories";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertCategory($catName){
		if (empty($this->checkCat($catName))) 
		{
			$storecatName = strtoupper($catName);
			$date = date('Y-m-d');
			$insert = "INSERT INTO categories(name,date_create)Values('$storecatName','$date')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				echo '<div class ="alert alert-success"> <strong> New category Added Successfully  </strong> </div>';
			}

		}
		else{
			echo $this->checkCat($catName);
		}
	}

	public function checkCat($catName){
		$storecatName = strtoupper($catName);
		$stmt = "SELECT * FROM categories where name = '$storecatName' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! category  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function updateCategory($name,$id){
	 $upname = strtoupper($name);
	 $stmt = "UPDATE categories set name = '$upname' where id = '$id'";
	 $result = $this->connect()->query($stmt);
	 if($result)
	 {
	 	echo '<div class ="alert alert-success"> <strong> category Updated  </strong> </div>';
	 }
	 else{
	 	echo '<div class ="alert alert-danger"> <strong> Sorry !!! Try again  </strong> </div>';
	 }

	}

	public function deleteCat($id)
	{
		$stmt = "DELETE FROM categories where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Category Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}


	public function allProduct(){
		$stmt = "SELECT * FROM product";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertProduct($name,$description,$price,$eDate,$catID){
		if (empty($this->checkProduct($name))) 
		{
			$storeProduct = strtoupper($name);
			$date = date('Y-m-d');
			$insert = "INSERT INTO product(name,description,price,expried_date,cat_id,date_create) Values ('$storeProduct','$description','$price','$eDate','$catID','$date')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				echo '<div class ="alert alert-success"> <strong> New Product Added Successfully  </strong> </div>';
			}

		}
		else{
			echo $this->checkProduct($name);
		}
	}

	public function checkProduct($name){
		$storeProduct = strtoupper($name);
		$stmt = "SELECT * FROM product where name = '$storeProduct' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! Product  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function getProductCat($id)
	{
		$stmt = "SELECT Name FROM categories where id = '$id'";
		$result= $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		else{

		}
	}

	public function allOneProduct($id){
		$stmt = "SELECT * FROM product where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
			if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			return $data;
		}
		else{
			return '';
		}
	}

	public function updateProduct($name,$description,$price,$eDate,$catID,$getID){

	 $upper_productName = strtoupper($name);
	 $stmt = "UPDATE product set name = '$upper_productName', description = '$description', price ='$price',expried_date ='$eDate', cat_id = '$catID' where id = '$getID'";
	 $result = $this->connect()->query($stmt);
	 if($result)
	 {
	 	echo '<div class ="alert alert-success"> <strong> Record Update Successfully </strong> <a href="manageProduct.php">Back to Product</a> </div>';
	 }
	 else{
	 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

	 }
	  exit();

	}
	
	public function UpdateQuantityProduct($quantity,$productID)
	{

	if ($quantity < ($this->checkProductQuantities($productID))) {
		echo '<div class ="alert alert-danger"> <strong> Quantity Can not be less </strong> </div>';
	}
	else
	{
		$stmt = "UPDATE product set quantity = '$quantity' where id = '$productID'";
		 $result = $this->connect()->query($stmt);
		 if($result)
		 {
		 	echo '<div class ="alert alert-success"> <strong> Quantity Updated Successfully </strong> </div>';
		 }
		 else{
		 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

		 }
	}
	 
	}

	 public function checkProductQuantities($id){
		$stmt = "SELECT quantity from product where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		
		else{
			return '';
		}
	}

	public function deleteProduct($id)
	{
		$stmt = "DELETE FROM product where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Record Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}
	public function allVaccination(){
		$stmt = "SELECT * FROM vaccination";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertVaccine($vac_date,$vac_reason,$vac_no,$description)
	{

		$date = date('Y-m-d');
		$insert = "INSERT INTO vaccination(vac_date,vac_reason,no_vac,description) Values ('$vac_date','$vac_reason','$vac_no','$description')";
		$stmt = $this->connect()->query($insert);
		if (!$stmt) {
			echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
		}
		else
		{
			echo '<div class ="alert alert-success"> <strong> New vaccination Added Successfully  </strong> </div>';
		}

	}
	public function deleteVaccine($id)
	{
		$stmt = "DELETE FROM vaccination where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Record Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function updateVaccine($vac_date,$vac_reason,$vac_no,$description,$id)
	{

		$stmt = "UPDATE vaccination set vac_date = '$vac_date', vac_reason = '$vac_reason', no_vac = '$vac_no', description ='$description'  where id = '$id'";
		 $result = $this->connect()->query($stmt);
		 if($result)
		 {
		 	echo '<div class ="alert alert-success"> <strong> vaccination Record Updated Successfully </strong> <a href="vaccination.php">Back to Manage vaccination</a></div>';
		 }
		 else{
		 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

		 }

		 exit();
	}


	public function allFeed(){
		$stmt = "SELECT * FROM feed";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertFeed($c_type,$f_type,$quantity)
	{

		$date = date('Y-m-d');
		$insert = "INSERT INTO feed(date_create,chicken_type,feed_type,quantity) Values ('$date','$c_type','$f_type','$quantity')";
		$stmt = $this->connect()->query($insert);
		if (!$stmt) {
			echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
		}
		else
		{
			echo '<div class ="alert alert-success"> <strong> New feed Added Successfully  </strong> </div>';
		}

	}

	public function deleteFeed($id)
	{
		$stmt = "DELETE FROM feed where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Record Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function allOneFeed($id){
		$stmt = "SELECT * FROM feed where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
			if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			return $data;
		}
		else{
			return '';
		}
	}

	public function updateFeed($c_type,$f_type,$quantity,$getID)
	{

		$stmt = "UPDATE feed set quantity = '$quantity', chicken_type = '$c_type', feed_type = '$f_type'  where id = '$getID'";
		 $result = $this->connect()->query($stmt);
		 if($result)
		 {
		 	echo '<div class ="alert alert-success"> <strong> Feed Record Updated Successfully </strong> <a href="feed.php">Back to Manage Feeds</a></div>';
		 }
		 else{
		 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

		 }

		 exit();
	}

	public function allMedication(){
		$stmt = "SELECT * FROM medication";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertMedication($name,$number,$description)
	{

		$date = date('Y-m-d');
		$insert = "INSERT INTO medication(name,noFlock,description,date_create) Values ('$name','$number','$description','$date')";
		$stmt = $this->connect()->query($insert);
		if (!$stmt) {
			echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again! </strong> </div>';
		}
		else
		{
			echo '<div class ="alert alert-success"> <strong> New medication Added Successfully  </strong> </div>';
		}

	}

	public function allOneMedication($id){
		$stmt = "SELECT * FROM medication where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
			if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			return $data;
		}
		else{
			return '';
		}
	} 

	public function updateMedication($medName,$number,$description,$getID)
	{

		$stmt = "UPDATE medication set name = '$medName', noFlock = '$number', description = '$description'  where id = '$getID'";
		 $result = $this->connect()->query($stmt);
		 if($result)
		 {
		 	echo '<div class ="alert alert-success"> <strong> medication Record Updated Successfully </strong> <a href="medication.php">Back to Manage medication</a></div>';
		 }
		 else{
		 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

		 }

		 exit();
	}

	public function deleteMedication($id)
	{
		$stmt = "DELETE FROM medication where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Record Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function allexpenses(){
		$stmt = "SELECT * FROM expenses";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertExpenses($title,$category,$quantity,$amount,$pMethod,$pFrom,$date_spend)
	{

		$date = date('Y-m-d');
		$insert = "INSERT INTO expenses(title,category,quantity,amount,pMethod,pFrom,date_create) 
					Values ('$title','$category','$quantity','$amount','$pMethod','$pFrom','$date_spend')";
		$stmt = $this->connect()->query($insert);
		if (!$stmt) {
			echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again! </strong> </div>';
		}
		else
		{
			echo '<div class ="alert alert-success"> <strong> New Expenses Added Successfully  </strong> </div>';
		}

	}

	public function deleteExpenses($id)
	{
		$stmt = "DELETE FROM expenses where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Record Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function updateExpenses($title,$category,$quantity,$amount,$pMethod,$pFrom,$getID)
	{

		$stmt = "UPDATE expenses set title = '$title', quantity = '$quantity', category = '$category', amount ='$amount', pMethod ='$pMethod', pFrom = '$pFrom'  where id = '$getID'";
		 $result = $this->connect()->query($stmt);
		 if($result)
		 {
		 	echo '<div class ="alert alert-success"> <strong> medication Record Updated Successfully </strong> <a href="expenses.php">Back to Manage Expenses</a></div>';
		 }
		 else{
		 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

		 }

		 exit();
	}

	public function allEgg(){
		$stmt = "SELECT * FROM Egg";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertEgg($collected,$good,$bad,$date_create)
	{

		$date = date('Y-m-d');
		if ($collected < ($good+$bad)) {
			echo '<div class ="alert alert-danger"> <strong> collected Can not be less sum of Good and Damage </strong> </div>';
		}
		else{
			$insert = "INSERT INTO egg(collected,good,bad,date_create) 
						Values ('$collected','$good','$bad','$date_create')";
				$stmt = $this->connect()->query($insert);
				if (!$stmt) {
					echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again! </strong> </div>';
				}
				else
				{
					echo '<div class ="alert alert-success"> <strong> New Eggs Record Added Successfully  </strong> </div>';
				}
		}
		

	}

	public function deleteEgg($id)
	{
		$stmt = "DELETE FROM egg where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Record Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function updateEgg($collected,$good,$bad,$date_create,$getID)
	{

		$stmt = "UPDATE egg set collected = '$collected', good = '$good', bad = '$bad',date_create = '$date_create'  where id = '$getID'";
		 $result = $this->connect()->query($stmt);
		 if($result)
		 {
		 	echo '<div class ="alert alert-success"> <strong> Egg Record Updated Successfully </strong> <a href="egg.php">Back to Manage Eggs</a></div>';
		 }
		 else{
		 	echo '<div class ="alert alert-danger"> <strong> Problem Occured... Try agin!!!</strong> </div>';

		 }

		 exit();
	}

	public function allFlock(){
		$stmt = "SELECT * FROM flock";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function insertFlock($available,$sick,$dead,$date_create)
	{

		$date = date('Y-m-d');
		if ($available < ($sick+$dead)) {
			echo '<div class ="alert alert-danger"> <strong> Available Can not be less sum of sick and Dead </strong> </div>';
		}
		else{
			$insert = "INSERT INTO flock(available,sick,dead,date_create) 
						Values ('$available','$sick','$dead','$date_create')";
				$stmt = $this->connect()->query($insert);
				if (!$stmt) {
					echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again! </strong> </div>';
				}
				else
				{
					echo '<div class ="alert alert-success"> <strong> New Flock Record Added Successfully  </strong> </div>';
				}
		}
		

	}

	public function deleteFlock($id)
	{
		$stmt = "DELETE FROM flock where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) 
		{
			echo '<script>alert("Record Deleted Successfully")</script>';
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	############################################################



	// ###################  users registration ##########################
	public function registerUser($email,$password,$confirmPassword)
	{
		if  (!empty($this->checkUserEmail($email)))
		{
			echo $this->checkUserEmail($email);
		}
		else{
			if ($password != $confirmPassword) {
				echo '<div class ="alert alert-danger"> <strong> Password does not match </strong> </div>';
			}
			else{
					$date = date('Y-m-d'); $hashPassword = md5($password);
					$insert = "INSERT INTO user(email,password,date_create) Values ('$email','$hashPassword','$date')";
					$stmt = $this->connect()->query($insert);
					if (!$stmt) {
						echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again! </strong> </div>';
					}
					else
					{
						echo '<div class ="alert alert-success"> <strong> Registration Successfully  </strong> </div>';
					}
			}
			
		}
	}

	public function checkUserEmail($email)
	{

		$stmt = "SELECT * FROM user where email = '$email' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! User  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function checkUserNewEmail($email)
	{

		$stmt = "SELECT * FROM profile where email = '$email' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! User  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function userProfile($fname,$lname,$dob,$gender,$address,$phoneNo,$email)
	{
		
			if (empty($phoneNo)) 
			{
				echo '<div class ="alert alert-danger"> <strong> Sorry !!! phone is required  </strong> </div>';
			}
			else
			{
				$date_add = date('Y-m-d');
				$target_dir = "uploads/";
	                    $target_file1 = $target_dir . basename($_FILES["passport"]["name"]);
	                    $uploadOk = 1;
	                    $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
		                $check = getimagesize($_FILES["passport"]["tmp_name"]);
	                    if($check !== false) 
	                    {
	                        //echo "File is an image - " . $check["mime"] . ".";
	                        $uploadOk = 1;
	                    } 
	                    else {
	                    	echo '<div class ="alert alert-danger"> <strong> Sorry !!! Passport is not an image. Please select Image file !  </strong> </div>';
	                        $uploadOk = 0;
	                    }
	                    // check passport
	                    if ($_FILES["passport"]["size"] > 5000000) 
		                  {
		                  	echo '<div class ="alert alert-danger"> <strong> Sorry, your Passport file is too large. Must not be more than 5MB  </strong> </div>';
		                      $uploadOk = 0;
		                  }

	                      // Allow certain file formats
	                     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
	                      {
	                      	echo '<div class ="alert alert-danger"> <strong> Sorry, only JPG, JPEG, PNG  format is allowed for Passport.</strong> </div>';
	                          $uploadOk = 0;
	                      }
	                      if ($uploadOk == 0) 
	                      {
	                      	echo '<div class ="alert alert-danger"> <strong> Sorry, your file was not uploaded. Please retry.</strong> </div>';
	                            

	                      // if everything is ok, try to upload file
	                      }
		              else
		              {
		              	if ( (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file1)))
		              	{

	              		$stmtx = "INSERT INTO profile(fname,lname,dob,gender,address,phone,email,date_create,passport) 
			              		values('$fname','$lname','$dob','$gender','$address','$phoneNo','$email','$date_add','$target_file1')";
		              		if ($this->connect()->query($stmtx)) 
		              		{
		              			
		              				echo '<div class ="alert alert-success"> <strong> profile Update Successfully.</strong> </div>';
							}
							else
							{
								echo '<div class ="alert alert-danger"> <strong> Error occured Please try again !.</strong> </div>';
							}

		              	}
		              	else{
		              		echo '<div class ="alert alert-danger"> <strong> Error occured Please Contact Admin for help !.</strong> </div>';
		              	}
              	
		              }
			}
	}

	public function allOneUser($email){
		$stmt = "SELECT * FROM profile where email = '$email'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
			if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			return $data;
		}
		else{
			return '';
		}
	}

	public function cartOrder($productID,$custID,$quantity){
		$counter = 0;
		$date = date('Y-m-d');
		$insert = "INSERT INTO orders(productID,custID,quantity,date_create) Values ('$productID','$custID','$quantity','$date')";
		$result = $this->connect()->query($insert);
		if($result){
			$counter += $quantity;
		}
		else{
			$counter = 0
			echo "<script>alert('Somtething went wrong')</script>";
		}
	}


	public function allOrders(){
		$stmt = "SELECT * FROM orders";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	function updateCartOrder($productID,$quantity){
		$stmt = "UPDATE product set quantity = '$quantity' where id = '$productID'";
		$result = $this->connect()->query($stmt);
	}

####################################### End of User Query ##########################################################
	public function update_row($productName,$productPrice,$productQuantity,$id){

	 $upper_productName = strtoupper($productName);
	 $stmt = "UPDATE product set productName = '$upper_productName', productPrice = '$productPrice', quantity ='$productQuantity' where id = '$id'";
	 $result = $this->connect()->query($stmt);
	 if($result)
	 {
	 	echo "success";
	 }
	 else{
	 	echo '<script>alert("Please Try Agin. Error Occured")</script>';
	 }
	 	
	 exit();

	}

	public function productCategory(){
		$stmt = "SELECT * FROM categories";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}

	public function storeCategory($catName){
		if (empty($this->checkCategory($catName))) 
		{
			$storecatName = strtoupper($catName);
			$date = date('Y-m-d');
			$insert = "INSERT INTO categories(name,date_add)Values('$storecatName','$date')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				echo '<div class ="alert alert-success"> <strong> New category Added Successfully  </strong> </div>';
			}

		}
		else{
			echo $this->checkCategory($catName);
		}
	}

	public function checkCategory($catName){
		$storecatName = strtoupper($catName);
		$stmt = "SELECT * FROM categories where name = '$storecatName' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! category  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function update_cat($name,$id){
	 $upname = strtoupper($name);
	 $stmt = "UPDATE categories set name = '$upname' where id = '$id'";
	 $result = $this->connect()->query($stmt);
	 if($result)
	 {
	 	echo "success";
	 }
	 else{
	 	
	 }
	 	
	 exit();

	}

	public function delete_cat($id)
	{
		$stmt = "DELETE FROM categories where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) {
			echo "success";
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}

	public function delete_product($id)
	{
		$stmt = "DELETE FROM product where id = '$id'";
		$result = $this->connect()->query($stmt);
		if ($result) {
			echo "success";
		}
		else{
			echo '<script>alert("Please Try Agin. Error Occured")</script>';
		}
	}
	
	public function getProductCategory($id)
	{
		$stmt = "SELECT Name FROM categories where id = '$id'";
		$result= $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		else{

		}
	}

	public function getAllCustomers()
	{
		$stmt = "SELECT * FROM customers";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			while ($rows= $result->fetch_assoc()) {
				$row_date [] = $rows;
		}
		 return $row_date;
			
		}
		else{
			return '';
		}
	}
	
	public function storeCustomer($name,$phoneNo,$email,$address){
		if (empty($this->checkCustomer($phoneNo,$email))) 
		{
			$date = date('Y-m-d');
			$insert = "INSERT INTO customers(fullName,phoneNo,address,email,date_add)Values('$name','$phoneNo','$address','$email','$date')";
			$stmt = $this->connect()->query($insert);
			if (!$stmt) {
				echo '<div class ="alert alert-danger"> <strong> Error Occured !!! Please Try Again </strong> </div>';
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("Congratulation!","New customer Added Successfully !","success");';
				echo '}, 1000);</script>';
			}

		}
		else{
			echo $this->checkCustomer($phoneNo,$email);
		}
	}

	public function checkCustomer($phoneNo,$email){

		$stmt = "SELECT * FROM customers where phoneNo = '$phoneNo' OR email = '$email' ";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows; 
		if (($numberrows)> 0) {
			return '<div class ="alert alert-danger"> <strong> Sorry !!! customer  Already Exist  </strong> </div>';
			 
		}
		else{

		}
	}

	public function cart($quantity){
		$stmt = "INSERT into customer_cart(quantity,custID,prdID)Values('$quantity','1','1')";
		$result = $this->connect()->query($stmt);
		if ($result) {
			echo "success";
		}
		else{
			echo "Error Occured!!!";
		}
	}
	public function getCart($custID)
	{
		$stmt = "SELECT * from customer_cart where custID = '$custID'";
		$result = $this->connect()->query($stmt);
		if ($result->num_rows > 0) {
			while ($rows = $result->fetch_assoc()) {
				$data[] = $rows;
			}
			return $data;
		}
		else{
			return '';
		}
	}

	public function getCartProduct($id)
	{
		$stmt = "SELECT * from product where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) 
		{
			$data = $result->fetch_assoc();
			return $data;
		}
		else{
			return '';
		}
	}

	public function storetoCart($id,$quantitys,$date,$custName,$custNumber,$custAddress,$transcationID)
	{
		$smtm = "INSERT INTO customer_cart(prdID,quantity,date_add,customerName,customerNumber,customerAddress,transcationID) VALUES('$id','$quantitys','$date','$custName','$custNumber','$custAddress','$transcationID') ";
      	$result = $this->connect()->query($smtm);
      	if ($result) 
      	{
      		$stmt = "SELECT * from product where id = '$id'";
      		$checkresult = $this->connect()->query($stmt);
      		$fetech_data = $checkresult->fetch_assoc();
      		$productid =   $fetech_data['id'];
      		$newQuantity = ($fetech_data['quantity']) - ($quantitys);
      		$newUpdate = $this->connect()->query("UPDATE product set quantity = '$newQuantity' where id = $productid");

      	}
      	else{
        $_SESSION['errorMes'] = 'Error Ocurred';
        header('location:suppliers.php');
      }
	}

	public function sales(){
		$stmt = "SELECT * FROM customer_cart";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows >0) {
			$counter = 1;
			while ($rows= $result->fetch_assoc()) {
				// $data[] = $rows;
				if (substr($rows['date_add'], 8,2) == date('d')) {
					
					$data[] = $rows;
				}
				else{

				}
			}
			return $data;
			
		}
	}

	public function saless($report){
			if ($report =='daily') {
				// daily code
				return $this->sales();

			}
			elseif ($report =='weekly') {
				// weekly code
				$stmt = "SELECT * FROM customer_cart";
				$result = $this->connect()->query($stmt);
				$numberrows = $result->num_rows;
				if ($numberrows >0) {
					$counter = 1;
					while ($rows= $result->fetch_assoc()) {
						// $data[] = $rows;
						if ($this->weekOfMonth($rows['date_add']) == $this->weekOfMonth(date('Y-m-d'))) {
							
							$data[] = $rows;
						}
						else{

						}
					}
					return $data;
					
				}

			}
			elseif ($report == 'monthly') {
				//monthly code...
				$stmt = "SELECT * FROM customer_cart";
				$result = $this->connect()->query($stmt);
				$numberrows = $result->num_rows;
				if ($numberrows >0) {
					$counter = 1;
					while ($rows= $result->fetch_assoc()) {
						// $data[] = $rows;
						if (substr($rows['date_add'], 5,2) == date('m') && substr($rows['date_add'], 0,4) == date('Y')) {
							
							$data[] = $rows;
						}
						else{

						}
					}
					return $data;
					
				}
			}
			else{
				$date = date('Y-m-d');
				$stmt = "SELECT * FROM customer_cart where date_add = '$date'";
				$result = $this->connect()->query($stmt);
				$numberrows = $result->num_rows;
				if ($numberrows >0) {
					$counter = 1;
					while ($rows= $result->fetch_assoc()) {
						$data[] = $rows;
					}
					return $data;
					
				}
			}
	}

	  function weekOfMonth($qDate) {
	    $dt = strtotime($qDate);
	    $day  = date('j',$dt);
	    $month = date('m',$dt);
	    $year = date('Y',$dt);
	    $totalDays = date('t',$dt);
	    $weekCnt = 1;
	    $retWeek = 0;
	    for($i=1;$i<=$totalDays;$i++) {
	        $curDay = date("N", mktime(0,0,0,$month,$i,$year));
	        if($curDay==7) {
	            if($i==$day) {
	                $retWeek = $weekCnt+1;
	            }
	            $weekCnt++;
	        } else {
	            if($i==$day) {
	                $retWeek = $weekCnt;
	            }
	        }
	    }
	    return $retWeek;
}

	public function getCustomerName($id){
		$stmt = "SELECT fullName from customers where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		else{
			return '';
		}
	}

	public function getCustomerdeatils($id){
		$stmt = "SELECT * from customer_cart where transcationID = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			//$data = $result->fetch_assoc();
			while ($data = $result->fetch_assoc()) {
				$datas [] = $data;
			}
			return $datas;
		}
		else{
			return '';
		}
	}

	public function getProductName($id){
		$stmt = "SELECT name from product where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		else{
			return '';
		}
	}

	public function getProductPrice($id){
		$stmt = "SELECT price from product where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		else{
			return '';
		}
	}

	public function getTotal($prodID,$quantity)
	{
		$prod = $this->getCartProduct($prodID);
		// $fetch = $prod->fetch_assoc();
		$productPrice = $prod['productPrice'];
		$sum = $productPrice * $quantity;
		return $sum;
		// return $fetch['id'];
	}
	public function customerCart()
	{
		$stmt = "SELECT * FROM customer_cart";
				$result = $this->connect()->query($stmt);
				$numberrows = $result->num_rows;
				if ($numberrows >0) {
					$counter = 1;
					while ($rows= $result->fetch_assoc()) 
					{
						$data[] = $rows;
					}
					return $data;
				}
	}

	public function checkProductQuantity($id){
		$stmt = "SELECT quantity from product where id = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			$string = implode('|',$data);
			return $string;
		}
		
		else{
			return '';
		}
	}

	public function salesReport(){
		$stmt = "SELECT * from customer_cart WHERE transcationID IS NOT NULL ORDER BY id";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$datas  = [];
			while($data = $result->fetch_assoc())
			{
				if(count($datas) > 0) {
					if(array_search($data['transcationID'], $datas) ==  false ) 
					{
					 	array_push($datas, $data);
					}
					else
					{
						//array_push($new_data, $data);
					}
				}
				else{
					array_push($datas, $data);
				}

			}
			return $datas;

		}
		
		else{
			return '';
		}
	}

	// public function getProductPrice($id)
	// {
	// 	$stmt = "SELECT productPrice FROM product where id = '$id'";
	// 	$result= $this->connect()->query($stmt);
	// 	$numberrows = $result->num_rows;
	// 	if ($numberrows > 0) {
	// 		$data = $result->fetch_assoc();
	// 		$string = implode('|',$data);
	// 		return $string;
	// 	}
	// 	else{

	// 	}
	// }

	public function getParticularCustomer($id){
		$stmt = "SELECT * from customer_cart where transcationID = '$id'";
		$result = $this->connect()->query($stmt);
		$numberrows = $result->num_rows;
		if ($numberrows > 0) {
			$data = $result->fetch_assoc();
			return $data;
		}
		else{
			return '';
		}
	}


/* ===================================================================*/
}
// end of class
$object = new user();