 <div class="row g-3">
     <div class="col-12">
         <h3 class="h4 text-black mb-3">Category</h3>
         <div class="list-group">
             <a class="list-group-item" href="{{ route('dashboard') }}">
                 <div class="icon" style="width: 45px; height: 45px">
                     <i class="fa-solid fa-gauge"></i>
                 </div>
                 <span>Dashboard</span>
             </a>
             <a class="list-group-item" href="{{ route('user.profile') }}">
                 <div class="icon" style="width: 45px; height: 45px">
                     <i class="fa-solid fa-gear"></i>
                 </div>
                 <span>Settings</span>
             </a>
             <a class="list-group-item disabled-link" aria-disabled="true">
                 <div class="icon" style="width: 45px; height: 45px">
                     <i class="fa-solid fa-credit-card"></i>
                 </div>
                 <span>Buy Credits</span>
             </a>
             <a class="list-group-item" href="{{ route('user.property.enquiry') }}">
                 <div class="icon" style="width: 45px; height: 45px">
                     <i class="fa-solid fa-history"></i>
                 </div>
                 <span>Property logs <span class="badge badge-danger align-middle ms-1 py-1">{{ count($userViewings ?? []) }}</span></span></span>
             </a>
             <a class="list-group-item" href="{{ route('user.property.wishlist') }}">
                 <div class="icon" style="width: 45px; height: 45px">
                     <i class="fa-solid fa-heart"></i>
                 </div>
                 <span>Property Wishlist <span class="badge badge-danger align-middle ms-1 py-1">{{ count($userWishlist ?? []) }}</span></span>
             </a>
             <a class="list-group-item" href="{{ route('user.change.password') }}">
                 <div class="icon" style="width: 45px; height: 45px">
                     <i class="fa-solid fa-key"></i>
                 </div>
                 <span>Security</span>
             </a>
             <a class="list-group-item" href="{{ route('user.logout') }}">
                 <div class="icon" style="width: 45px; height: 45px">
                     <i class="fa-solid fa-arrow-right-from-bracket"></i>
                 </div>
                 <span>Logout</span>
             </a>
         </div>
     </div>
 </div>