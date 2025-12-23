<div class="mainProfile">
  <!-- Thông tin cá nhân -->
  <div class="mainProfile-data">
    <!-- Ava + name... -->
    <div class="mainProfile-individual">
      <img src="<?php echo $_SESSION["user"]["avatar"]?>" alt="" class="profile-avatar" />

      <div class="profile-name">
        <h1 class="profile-fullname"><?php echo $_SESSION["user"]["full_name"];?></h1>
        <p class="profile-username">@<?php echo $_SESSION["user"]['username'];?></p>
        <p class="profile-address">
          <i class="fa fa-location-arrow" aria-hidden="true"></i> Nha
          Trang
        </p>
      </div>
      <p class="profile-more">...</p>
    </div>

    <div class="mainProfile-content" id="profileContent">
      <div class="mainProfile-text">
        "Nếu bạn may mắn có ông bà hay là ba mẹ là những người thích
        nấu nướng, tôi tin rằng mùi bánh mới nướng sẽ là một trong
        những hương vị tuyệt vời nhất đọng lại trong kí ức tuổi thơ
        của bạn"
        <div>
          Mình tên thật là Anh Thư - có sở thích bánh trái, nấu nướng
          và đi du lịch
        </div>
        <a
          href="https://www.facebook.com/nguyen.kien.762312/about">https://www.facebook.com/nguyen.kien.762312/about</a>
        <br />
        <a
          href="https://www.facebook.com/nguyen.kien.762312/about">https://www.facebook.com/nguyen.kien.762312/about</a>
      </div>

      <!-- Nút xem thêm -->
      <!-- <span class="read-more" id="readMoreBtn">XEM THÊM</span> -->
    </div>
    <div style="display: flex; gap: 10px; margin: 10px">
      <div style="font-size: 13px" class="kitchen-friend">
        <b>987</b> Bạn bếp
      </div>
      <div style="font-size: 13px" class="interested-person">
        <b>10.699</b> Người quan tâm
      </div>
    </div>
  </div>

  <!-- Nút sửa thông tin cá nhân (Tài khoản của mình) or Kết bạn (Tài khoản người khác) -->
  <div class="fixProfileData-btn">
    <button>Sửa thông tin cá nhân</button>
  </div>

  <!-- Các công thức -->
  <div class="mainProfile-selections">
    <div class="finding-results">

      <!--card món ăn -->
      <article class="recipe-card" onclick="">
        <div class="recipe-content">
          <div class="recipe-author">
            <img src="/public/images/img/avatar1.webp" class="author-avatar" />
            <span class="author-name">Cẩm Đạt</span>
          </div>

          <h3 class="recipe-title">Nấu cháo bằng nồi cơm điện</h3>

          <p class="recipe-desc">gạo 400ml nước • nấm bào ngư • cà rốt • ngô • thịt băm</p>

          <div class="recipe-meta">
            <span>Chuẩn bị 10p</span>
            <span class="meta-dot">•</span>
            <span>Chế biến 15p</span>
            <span class="meta-dot">•</span>
            <span>1 người</span>
          </div>
        </div>

        <div class="recipe-media">
          <button class="recipe-save" onclick="toggleSave(event, this)">
            <i class="fa-regular fa-bookmark"></i>
          </button>

          <img src="/public/images/img/finding1.webp" class="recipe-thumb" />
        </div>
      </article>

      <article class="recipe-card" onclick="">
        <div class="recipe-content">
          <div class="recipe-author">
            <img src="/public/images/img/avatar1.webp" class="author-avatar" />
            <span class="author-name">Cẩm Đạt</span>
          </div>

          <h3 class="recipe-title">Nấu cháo bằng nồi cơm điện</h3>

          <p class="recipe-desc">gạo 400ml nước • nấm bào ngư • cà rốt • ngô • thịt băm</p>

          <div class="recipe-meta">
            <span>Chuẩn bị 10p</span>
            <span class="meta-dot">•</span>
            <span>Chế biến 15p</span>
            <span class="meta-dot">•</span>
            <span>1 người</span>
          </div>
        </div>

        <div class="recipe-media">
          <button class="recipe-save" onclick="toggleSave(event, this)">
            <i class="fa-regular fa-bookmark"></i>
          </button>

          <img src="/public/images/img/finding1.webp" class="recipe-thumb" />
        </div>
      </article>

      <article class="recipe-card" onclick="">
        <div class="recipe-content">
          <div class="recipe-author">
            <img src="/public/images/img/avatar1.webp" class="author-avatar" />
            <span class="author-name">Cẩm Đạt</span>
          </div>

          <h3 class="recipe-title">Nấu cháo bằng nồi cơm điện</h3>

          <p class="recipe-desc">gạo 400ml nước • nấm bào ngư • cà rốt • ngô • thịt băm</p>

          <div class="recipe-meta">
            <span>Chuẩn bị 10p</span>
            <span class="meta-dot">•</span>
            <span>Chế biến 15p</span>
            <span class="meta-dot">•</span>
            <span>1 người</span>
          </div>
        </div>

        <div class="recipe-media">
          <button class="recipe-save" onclick="toggleSave(event, this)">
            <i class="fa-regular fa-bookmark"></i>
          </button>

          <img src="/public/images/img/finding1.webp" class="recipe-thumb" />
        </div>
      </article>

      <article class="recipe-card" onclick="">
        <div class="recipe-content">
          <div class="recipe-author">
            <img src="/public/images/img/avatar1.webp" class="author-avatar" />
            <span class="author-name">Cẩm Đạt</span>
          </div>

          <h3 class="recipe-title">Nấu cháo bằng nồi cơm điện</h3>

          <p class="recipe-desc">gạo 400ml nước • nấm bào ngư • cà rốt • ngô • thịt băm</p>

          <div class="recipe-meta">
            <span>Chuẩn bị 10p</span>
            <span class="meta-dot">•</span>
            <span>Chế biến 15p</span>
            <span class="meta-dot">•</span>
            <span>1 người</span>
          </div>
        </div>

        <div class="recipe-media">
          <button class="recipe-save" onclick="toggleSave(event, this)">
            <i class="fa-regular fa-bookmark"></i>
          </button>

          <img src="/public/images/img/finding1.webp" class="recipe-thumb" />
        </div>
      </article>

      <article class="recipe-card" onclick="">
        <div class="recipe-content">
          <div class="recipe-author">
            <img src="/public/images/img/avatar1.webp" class="author-avatar" />
            <span class="author-name">Cẩm Đạt</span>
          </div>

          <h3 class="recipe-title">Nấu cháo bằng nồi cơm điện</h3>

          <p class="recipe-desc">gạo 400ml nước • nấm bào ngư • cà rốt • ngô • thịt băm</p>

          <div class="recipe-meta">
            <span>Chuẩn bị 10p</span>
            <span class="meta-dot">•</span>
            <span>Chế biến 15p</span>
            <span class="meta-dot">•</span>
            <span>1 người</span>
          </div>
        </div>

        <div class="recipe-media">
          <button class="recipe-save" onclick="toggleSave(event, this)">
            <i class="fa-regular fa-bookmark"></i>
          </button>

          <img src="/public/images/img/finding1.webp" class="recipe-thumb" />
        </div>
      </article>

      <article class="recipe-card" onclick="">
        <div class="recipe-content">
          <div class="recipe-author">
            <img src="/public/images/img/avatar1.webp" class="author-avatar" />
            <span class="author-name">Cẩm Đạt</span>
          </div>

          <h3 class="recipe-title">Nấu cháo bằng nồi cơm điện</h3>

          <p class="recipe-desc">gạo 400ml nước • nấm bào ngư • cà rốt • ngô • thịt băm</p>

          <div class="recipe-meta">
            <span>Chuẩn bị 10p</span>
            <span class="meta-dot">•</span>
            <span>Chế biến 15p</span>
            <span class="meta-dot">•</span>
            <span>1 người</span>
          </div>
        </div>

        <div class="recipe-media">
          <button class="recipe-save" onclick="toggleSave(event, this)">
            <i class="fa-regular fa-bookmark"></i>
          </button>

          <img src="/public/images/img/finding1.webp" class="recipe-thumb" />
        </div>
      </article>
    </div>
  </div>
</div>