<?php 
	require "includes/functions.php";
	$st_id=36;
	$sql="SELECT * FROM eh_students WHERE st_id=$st_id";
	$query=mysqli_query(Database::getConnection(),$sql);
	$result=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$result['fname']." ".$result['lname']?> - Hostel Registration Details</title>
</head>
<body>
	<h2 align="center" style="color: blue;">Vishwakarma Government Engineering Collage, Chandkheda</h2>
	<h3 align="center" style="color:maroon;"><u>Hostel Registration Details</u></h3>
	<table align="center" width="100%" border="0">
		<tr>
			<td align="left" ><strong>Date of Registration: </strong> : <?=$result['date_creation'];?></td>
			<td align="right"><strong>Date of Registration: </strong> : <?=$result['date_creation'];?></td>
		</tr>
		<tr>
			<td colspan="2">
				<fieldset>
					<legend style="font-size: 20px;">Personal Details</legend>
					<table width="100%" border="0">
						<tr>
							<td width="200" align="right"><strong>Name: </strong></td>
							<td><?=strtoupper($result['fname']." ".$result['mname']." ".$result['lname']) ?></td>
							<td rowspan="5" colspan="2" align="center">
								<img style="width: 80px;" src="<?=base_url($result['avatar']);?>">
							</td>
						</tr>
						<tr>
							<td align="right"><strong>Cast: </strong></td>
							<td><?=pull_cast_by_id($result['cast_id']);?></td>
						</tr>
						<tr>
							<td align="right"><strong>Gender: </strong></td>
							<td>
								<?php
									if($result['gender']=="M"){
										echo "Male";
									}

									if($result['gender']=="F"){
										echo "Female";
									}
								?>
							</td>
						</tr>
						<tr>
							<td align="right"><strong>Student Contact No.: </strong></td>
							<td><?=$result['contact']?></td>
						</tr>
						<tr>
							<td align="right"><strong>Student Email Address: </strong></td>
							<td><?=$result['email']?></td>
						</tr>
						<tr>
							<td align="right"><strong>Parents Contact No.: </strong></td>
							<td><?=$result['p_contact'];?></td>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td align="right"><strong>Address: </strong></td>
							<td width="40%;"><?=$result['pr_address'];?></td>

							<td align="right"><strong>City: </strong></td>
							<td><?=$result['pr_city'];?></td>
						</tr>
						<tr>
							<td align="right"><strong>District: </strong></td>
							<td width="40%;"><?=$result['pr_district'];?></td>

							<td align="right"><strong>State: </strong></td>
							<td><?=$result['pr_state'];?></td>
						</tr>

						<tr>
							<td align="right"><strong>Country: </strong></td>
							<td width="40%;"><?=$result['pr_country'];?></td>

							<td align="right"><strong>Pincode: </strong></td>
							<td><?=$result['pr_pincode'];?></td>
						</tr>
						<tr>
							<td colspan="2" align="right"><strong>Approximate distance in KM for your residence address to VGEC:</strong></td>
							<td colspan="2"><?=$result['distance']?> KM</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td colspan="2">
				<fieldset>
					<legend style="font-size: 20px;">Academic Details</legend>
					<table width="100%" border="0">
						<tr>
							<td align="right"><strong>ACPC Merit No.: </strong></td>
							<td><?=$result['enrollment'];?></td>

							<td align="right"><strong>Admission Branch.: </strong></td>
							<td><?=pull_dept_by_id($result['dept_id']);?></td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td colspan="2">
				<fieldset>
					<legend style="font-size: 20px;">Bank Details</legend>
					<table width="100%" border="0">
						<tr>
							<td align="right"><strong>Bank Account No.: </strong></td>
							<td><?=$result['bank_ac_no'];?></td>

							<td align="right"><strong>Account Holder's Name: </strong></td>
							<td><?=strtoupper($result['bank_ac_name']);?></td>
						</tr>
						<tr>
							<td align="right"><strong>Bank Name: </strong></td>
							<td><?=$result['bank_name'];?></td>

							<td align="right"><strong>Bank IFSC Code No.: </strong></td>
							<td><?=strtoupper($result['bank_ifsc']);?></td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td colspan="2">
				<fieldset>
					<legend style="font-size: 20px;">Submitted Documents</legend>
					<table width="100%" border="0">
						<tr>
							<td colspan="2">
								<ol type="number">
									<li> ACPC Admission Letter</li>
									<li> Residence Proof</li>
									<li> SBI Collect Fee Receipt</li>
								</ol>
							</td>							
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br></td>
		</tr>
		<tr>
			<td colspan="2">
				<fieldset>
					<legend style="font-size: 20px;">Agreement</legend>
					<table width="100%" border="0">
						<tr>
							<td colspan="2">
								<input type="checkbox" checked="checked">&nbsp;<label>I agree that data entered by me are correct and wrongly submission of data will cancel my application.</label>
							</td>							
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button type="button" onclick="javascript:window.print();">Print</button>
			</td>
		</tr>
	</table>
</body>
</html>