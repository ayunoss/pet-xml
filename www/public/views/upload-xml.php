<html lang="ru">
  <head>
    <title>Upload Xml</title>
      <script>
          function isUserAuthorize() {
              let cookies = document.cookie.split(';');
              console.log(cookies);
              console.log(cookies['session_id'])
              for (let i = 0; cookies.length > i; i++) {
                  let cookie = cookies[i].trim()
                  let cookieParts = cookie.split('=')
                  if (cookieParts[0] === 'session_id') {
                      return true;
                  }
              }
              return false;
          }

          if (!isUserAuthorize()) {
              alert('Please sign in to see this page.');
              window.location.href = '/';
          }
      </script>
  </head>
  <body>
  <form enctype="multipart/form-data">
      <h1>Here you can upload files</h1>
      <label>Choose files</label>
      <input id="upload-xml" type="file">
      <input type="button" class="btn btn-success" onclick="uploadXml()" value="upload">
  </form>
  <script>
      function uploadXml() {
          let input = document.getElementById('upload-xml');
          let formData = new FormData();
          formData.append('file', input.files[0]);
          fetch('/exec-upload', {
              method: "POST",
              body: formData
          });
          alert('The file has been uploaded successfully.');
      }
  </script>
  </body>
</html>