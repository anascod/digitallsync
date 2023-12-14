<?php 
require("config/sys.php");
SetSession();

EditData();
?>


<div class="formbold-main-wrapper">
	<!-- Author: FormBold Team -->
	<!-- Learn More: https://formbold.com -->
	<div class="formbold-form-wrapper">
	  
  
	  <form action="" method="POST">
		<div class="formbold-form-title">
		  <h2 class="">Conform Delivery Order </h2>
		  <p>
			
		  </p>
		</div>
  
		<div class="formbold-input-flex">
		  <div>
			<label for="firstname" class="formbold-form-label " >
      Draft No
			</label>
			
			<input
			  type="text"
			  name="firstname"
			  id="firstname"
			  class="formbold-form-input notallow"
        value="<?php 
		
foreach ($editesult as $edit){
			echo $edit['DRAFT_NO'];}
		?>"
        disabled
			/> 
		  </div>
		  <div>
			<label for="lastname" class="formbold-form-label "> Date </label>
			<input
			  type="text"
			  name="lastname"
			  id="lastname"
			  value="<?php 
		
		foreach ($editesult as $edit){
					echo $edit['Date'];}
				?>"
			  class="formbold-form-input notallow "
			  disabled
			/>
		  </div>
		</div>
  
		<div class="formbold-input-flex">
		  <div>
			<label for="email" class="formbold-form-label"> JOB.NO </label>
			<input
			  type="text"
			  name="jobno"
			  id="email"
			  class="formbold-form-input "
        value="<?php    
		foreach ($editesult as $edit){
			echo $edit['JOB_NO'];}
		?>"
		required
			/>
		  </div>
		  <div>
			<label for="phone" class="formbold-form-label"> TRANSPORTER </label>
			<input
			  type="text"
			  name="trans"
			  id="phone"
			  class="formbold-form-input "
			  value="<?php    
		foreach ($editesult as $edit){
			echo $edit['TRANSPORTER'];}
		?>"
		required
			/>
		  </div>
		</div>
  
		<div class="formbold-mb-3">
		  <label for="address" class="formbold-form-label">
      FROM
		  </label>
		  <input
			type="text"
			name="fromp"
			id="address"
			class="formbold-form-input "
		  value="<?php    
		foreach ($editesult as $edit){
			echo $edit['FROMP'];}
		?>"
		required
      />
	  <label for="address" class="formbold-form-label image">
      <?php   foreach ($editesult as $edit){
			echo "<center><img src='qrcode/qrcodefile/".$edit['CONTRACT_NO'].".svg'/></center>";}    
?>
		  </label>
		</div>
  
		<div class="formbold-mb-3">
		  <label for="address2" class="formbold-form-label">
      TO
		  </label>
		  <input
			type="text"
			name="top"
			id="address2"
			class="formbold-form-input"
			value="<?php    
		foreach ($editesult as $edit){
			echo $edit['TOPL'];}
		?>"
		required
		  />
		</div>
  
		<div class="formbold-input-flex">
		  <div>
			<label for="state" class="formbold-form-label "> CUSTOMER/CONTRACT </label>
			<input
			  type="text"
			  name="contract"
			  id="state"
			  class="formbold-form-input "
        value="<?php    
		foreach ($editesult as $edit){
			echo $edit['CONTRACT_NO'];}
		?>"
		required
        />
		  </div>
		  <div>
			<label for="country" class="formbold-form-label"> TYPE OF TRUCK  </label>
			<input
			  type="text"
			  name="trucktype"
			  id="country"
			  class="formbold-form-input notallow"
			  disabled
			  value="<?php    
		foreach ($editesult as $edit){
			echo $edit['TYPE_OF_TRUCK'];}
		?>"
        />
		  </div>
		  <div>
			<label for="country" class="formbold-form-label"> TRUCK NO </label>
			<input
			  type="text"
			  name="truckno"
			  id="country"
			  class="formbold-form-input notallow"
			  value="<?php    
		foreach ($editesult as $edit){
			echo $edit['TRUCK_NO'];}
		?>"
		disabled
			/>
		  </div>
		</div>
  
		<div class="formbold-input-flex">
		  <div>
			<label for="post" class="formbold-form-label"> DRIVER NAME  </label>
			<input
			  type="text"
			  name="drivername"
			  id="post"
			  class="formbold-form-input notallow"
			  disabled
			   value="<?php    
		foreach ($editesult as $edit){
			echo $edit['DRIVER_NAME'];}
		?>"
			/>
		  </div>
		  <div>
			<label for="area" class="formbold-form-label"> DRIVER MOBILE </label>
			<input
			  type="text"
			  name="driverno"
			  id="area"
			  class="formbold-form-input notallow"
			  disabled
			  value="<?php    
		foreach ($editesult as $edit){
			echo $edit['DRIVER_MOBILE'];}
		?>"
			/>
		  </div>
		  <div>
			<label for="area" class="formbold-form-label"> BAYAN No</label>
			<input
			  type="text"
			  name="bayan"
			  id="area"
			  class="formbold-form-input "
required
			  value="<?php    
		foreach ($editesult as $edit){
			echo $edit['BAYAN_NO'];}
		?>"
        
        />
		  </div>
		</div>
  
		
  
		<button class="formbold-btn" name="ordered">Conform</button>
	  </form>
	</div>
  </div>
  <style>
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
	* {
	  margin: 0;
	  padding: 0;
	  box-sizing: border-box;
	}
	body {
	  font-family: 'Inter', sans-serif;
	}
	.formbold-mb-3 {
	  margin-bottom: 15px;
	}
	.formbold-relative {
	  position: relative;
	}
	.formbold-opacity-0 {
	  opacity: 0;
	}
	.formbold-stroke-current {
	  stroke: currentColor;
	}
	#supportCheckbox:checked ~ div span {
	  opacity: 1;
	}
  
	.formbold-main-wrapper {
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  padding: 48px;
	}
  
	.formbold-form-wrapper {
	  margin: 0 auto;
	  max-width: 570px;
	  width: 100%;
	  background: white;
	  padding: 40px;
	}
  
	.formbold-img {
	  margin-bottom: 45px;
	}
  
	.formbold-form-title {
	  margin-bottom: 30px;
	}
	.formbold-form-title h2 {
	  font-weight: 600;
	  font-size: 28px;
	  line-height: 34px;
	  color: #07074d;
	}
	.formbold-form-title p {
	  font-size: 16px;
	  line-height: 24px;
	  color: #536387;
	  margin-top: 12px;
	}
  
	.formbold-input-flex {
	  display: flex;
	  gap: 20px;
	  margin-bottom: 15px;
	}
	.formbold-input-flex > div {
	  width: 50%;
	}
	.formbold-form-input {
	  text-align: center;
	  width: 100%;
	  padding: 13px 22px;
	  border-radius: 5px;
	  border: 1px solid #ffcdca;
	  background: #ffffff;
	  font-weight: 500;
	  font-size: 16px;
	  color: #536387;
	  outline: none;
	  resize: none;
	}

  .notallow{
    background: #c0c0c0;

  }
	.formbold-form-input:focus {
	  border-color: #6a64f1;
	  box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
	}
	.formbold-form-label {
	  color: #536387;
	  font-size: 14px;
	  line-height: 24px;
	  display: block;
	  margin-bottom: 10px;
	}
  
	.formbold-checkbox-label {
	  display: flex;
	  cursor: pointer;
	  user-select: none;
	  font-size: 16px;
	  line-height: 24px;
	  color: #536387;
	}
	.formbold-checkbox-label a {
	  margin-left: 5px;
	  color: #6a64f1;
	}
	.formbold-input-checkbox {
	  position: absolute;
	  width: 1px;
	  height: 1px;
	  padding: 0;
	  margin: -1px;
	  overflow: hidden;
	  clip: rect(0, 0, 0, 0);
	  white-space: nowrap;
	  border-width: 0;
	}
	.formbold-checkbox-inner {
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  width: 20px;
	  height: 20px;
	  margin-right: 16px;
	  margin-top: 2px;
	  border: 0.7px solid #dde3ec;
	  border-radius: 3px;
	}
  
	.formbold-btn {
	  font-size: 16px;
	  border-radius: 5px;
	  padding: 14px 25px;
	  border: none;
	  font-weight: 500;
	  background-color: #6a64f1;
	  color: white;
	  cursor: pointer;
	  margin-top: 25px;
	}
	.formbold-btn:hover {
	  box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
	}
	.image{
		width: 100%;
  max-width: 100px;
  height: auto;
  display: block;
  margin-left: auto;
  margin-right: auto;
	}
  </style>