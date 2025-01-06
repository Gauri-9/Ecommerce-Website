<div class="row px-4">
					<div class="col-md-4">
						<form method="post">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value = "<?php  echo $data['fullname'];?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"  value = "<?php  echo $data['email'];?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact"  value = "<?php  echo $data['contact'];?>" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age"  value = "<?php  echo $data['age'];?>" required>
                            </div>
                             <!-- <div class="form-group">
                                <label for="password">Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" required>
                             </div> -->
                             <button type="submit" class="btn btn-outline-primary" class="form-control" name="edit_button">Edit Profile</button>
                         </form>
                     </div>
                 </div>