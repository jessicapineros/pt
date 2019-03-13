<!--Form Space client-->

<div class="formulaire-connexion">

  <h1>ACCESS OUR CREATIVE PLATFORM</h1>

  <p>To get access to our creative platform, contact us via our dedicated page</p>
  <!--Form-->
  <div class="form-connexion-espace-client">
  <?php
  // Formulaire de connexion
    wp_login_form( array(
          'redirect'       => site_url( '/actualites' ), // par défaut renvoie vers la page courante
          'label_username' => 'Username or Email address',
          'label_password' => 'Password',
          'label_remember' => 'Remember Me',
          'label_log_in'   => 'Log In',
          'form_id'        => 'login-form',
          'id_username'    => 'user-login',
          'id_password'    => 'user-pass',
          'id_remember'    => 'rememberme',
          'id_submit'      => 'wp-submit',
          'remember'       => true, //afficher l'option se ouvenir de moi
          'value_remember' => false //se souvenir par défaut ?
    ) );
   ?>
 </div>
</div>
