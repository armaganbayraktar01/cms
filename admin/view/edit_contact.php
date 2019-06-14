<?php require admin_view('static/header') ?>

    <div class="box-">
        <h1>
            <?= $row_contacts['contact_subject'] . ' (' .  timeConvert($row_contacts['contact_date']) . ' gönderildi!)' ?>
        </h1>
    </div>

    <div class="box-container container-50">

        <?php if ($row_contacts['contact_read'] == 1): ?>
            <div class="message success box-">
                <?=timeConvert($row_contacts['contact_read_date'])?> <strong><?=$row_contacts['user_name']?></strong> tarafından okundu.
            </div>
        <?php endif; ?>

        <div class="box-">
            <form action="" method="post" class="form label">
                <ul>
                    <li>
                        <label style="height:0;">Ad-Soyad</label>
                        <div class="form-content" style="padding-top: 12px">
                            <?= $row_contacts['contact_name'] ?>
                        </div>
                    </li>
                    <li>
                        <label style="height:0;">E-posta</label>
                        <div class="form-content" style="padding-top: 12px">
                            <?= $row_contacts['contact_email'] ?>
                        </div>
                    </li>
                    <?php if ($row_contacts['contact_phone']): ?>
                        <li>
                            <label style="height:0;">Telefon</label>
                            <div class="form-content" style="padding-top: 12px">
                                <?= $row_contacts['contact_phone'] ?>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li>
                        <label style="height:0;">Konu</label>
                        <div class="form-content" style="padding-top: 12px">
                            <?= $row_contacts['contact_subject'] ?>
                        </div>
                    </li>
                    <li>
                        <label style="height:0;">Mesaj</label>
                        <div class="form-content" style="padding-top: 12px">
                            <?= nl2br($row_contacts['contact_message']) ?>
                        </div>
                    </li>
                </ul>
            </form>
        </div>

    </div>

    <div class="box-container container-50">  
        <div class="box" id="div-1">
            <h3>
            Yanıtla
            </h3>

            <div class="box-content">
                <div class="message success box-" style="display: none" id="success"></div>
                <div class="message error box-" style="display: none;" id="error"></div>
               
                <form id="email-form" onsubmit="return false;"  action="" class="form">
                    <input type="hidden" name="name" value="<?=$row_contacts['contact_name']?>">
                    <ul>
                        <li>
                            <input type="text" id="input" name="subject" value="Re: <?=$row_contacts['contact_subject']?>" placeholder="Konu">
                        </li>
                        <li>
                            <input type="text" id="input" name="email" value="<?=$row_contacts['contact_email']?>" placeholder="E-Posta Adresi">
                        </li>
                        <li>
                            <textarea class="editor" name="message" id="message" cols="30" rows="5" placeholder="Cevabınızı yazın.."></textarea>
                        </li>
                        <li>
                            <button onclick="send_email('#email-form')" type="submit">Güncelle</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

<?php require admin_view('static/footer') ?>