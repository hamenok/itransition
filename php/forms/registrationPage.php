<?php echo '
    <div class="regForm" id="form">
        <form>
            <div class="mb-3">
                <label for="InputLogin" class="form-label">Login</label>
                <input type="text" class="form-control" id="InputLogin">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="InputPassword">
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password again</label>
                <input type="password" class="form-control" id="InputPasswordAgain">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>
        </div>
      </div>
    </div>


' ?>