<header>
    <div class="profile-info">
        <div class="image-box">
            <img src="<?php echo $item['ppImg'] ?>" alt="../includes/img/profile.png">
            <div class="overlay">
                <input type="file" id="file-input" style="display:none;" accept="image/*">
                <button class="browse-btn" id="browse-btn">Upload</button>
            </div>
        </div>
        <div class="info-box">
            <?php if ($showElementGuru): ?>
                <div class="info" id="unedit">
                    <span class="l">Nama Lengkap: </span>
                    <span class="r" id="namatext"><?php echo $item['fullname']; ?></span>
                    <hr class="l">
                    <hr class="r">
                    <span class="l">Username: </span>
                    <span class="r" id="namatext"><?php echo $item['username']; ?></span>
                    <hr class="l">
                    <hr class="r">
                    <span class="l">Mapel: </span>
                    <span class="r" id="namatext"><?php echo $item['mapel']; ?></span>
                </div>
                <div class="info" id="edit" style="display: none">
                    <span class="l">Nama Lengkap: </span>
                    <span class="r" id="namatext"><?php echo $item['fullname']; ?></span>
                    <hr class="l">
                    <hr class="r">
                    <span class="l">Username: </span>
                    <input class="r" type="text" id="usernameInput" value="<?php echo $item['username']; ?>"
                        placeholder="Username">
                    <hr class="l">
                    <hr class="r">
                    <span class="l">Mapel: </span>
                    <input class="r" type="text" id="mapelInput" value="<?php echo $item['mapel']; ?>" placeholder="kalau banyak kasih , e.g: inggris, inggris TL">
                </div>
            <?php else: ?>
                <div class="info" id="unedit">
                    <span class="l">Nama Lengkap: </span>
                    <span class="r" id="namatext"><?php echo $item['fullname']; ?></span>
                    <hr class="l">
                    <hr class="r">
                    <span class="l">username: </span>
                    <span class="r" id="namatext"><?php echo $item['username']; ?></span>
                </div>
                <div class="info" id="edit" style="display: none">
                    <span class="l">Nama Lengkap: </span>
                    <span class="r" id="namatext"><?php echo $item['fullname']; ?></span>
                    <hr class="l">
                    <hr class="r">
                    <span class="l">username: </span>
                    <input class="r" type="text" id="usernameInput" value="<?php echo $item['username']; ?>"
                        placeholder="Username">
                </div>
            <?php endif; ?>
            <div class="info-footer">
                <button id="save" onclick="saveData(<?php echo $id; ?>)" style="display: none;">Save</button>
                <button id="cancel" onclick="cancelEdit()" style="display: none;">Cancel</button>
                <button id="edit-btn" onclick="editMode()">Edit</button>
                <?php if ($showElementMinat): ?>
                    <button>
                        <a href="peminatan/peminatan.php?data=<?php echo $encryptedUrl ?>">Ganti
                            Jadwal

                        </a>
                    </button>
                <?php endif; ?>
                <?php if ($showElementGuru): ?>
                    <button>
                        <a href="peminatan/peminatan.php?mnt=guru&data=<?php echo $encryptedUrl ?>">Ganti
                            Mapel

                        </a>
                    </button>
                <?php endif; ?>

            </div>
        </div>
    </div>
</header>