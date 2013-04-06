<div class="binaraCAPTCHA-html-helper-container">
    <style type="text/css">
        .binaraCAPTCHA-html-helper-container {
            display: block;
            width: 280px;
            border: #ffc23f solid 2px;
            border-radius: 6px;
            background-color: #ffc23f;
            font-family: sans-serif;
            font-size: 14px;
            padding: 4px;
        }

        .binaraCAPTCHA-html-helper-container img {
            display: block;
            margin: 4px auto 2px auto;
            border-radius: 4px;
        }

        .binaraCAPTCHA-html-helper-container input {
            display: block;
            float: left;
            width: 250px;
            border: #ffa23f solid 1px;
        }

        .binaraCAPTCHA-html-helper-container a {
            text-decoration: none;
            color: black;
        }

        .binaraCAPTCHA-html-helper-container a img {
            display: block;
            float: left;
            width: auto;
            border: none;
            padding: 0px;
            margin: 4px 0px 0px 6px;
            vertical-align: middle;
        }

        .binaraCAPTCHA-html-helper-container label {
            width: 100%;
            display: block;
            text-align: center;
            background-color: #FFF77F;
            border-radius: 2px;
        }

        .binaraCAPTCHA-html-helper-container span {
            color: #666666;
            display: block;
            font-size: 11px;
            margin: 0px 0px 0px 2px;
        }
    </style>
    <label>Enter the characters shown below</label>
    <img src="../web/image.php" id="binaraCAPTCHA" alt="CAPTCHA Image" title="Enter characters shown in this image" />
    <input type="text" id="binaraCAPTCHATextInput" name="binaraCAPTCHATextInput" />
    <a href="javascript: binara_reloadImage();" title="Reload Image">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAN1wAADdcBQiibeAAAAAd0SU1FB90DAg4cCRro3/kAAAELSURBVDjLldO/LkRREAbwnxU2ItFIvIBItCIRkdjCC6DUeQHUW2vQSBRaf6LU2EREgU4hQUhovIFSwSaL1cxNTtjr3p3kNPN938x858whPyawgIouooJlvKAdp1pWPIiTEL3hEKvoTTh11PIKHIe4geEczlFwbrCE/gyYD+ACff9MuZFY+8ZaBlyhhdECmyuJ+D71/onLEve0iL3gfmUXPBZVd0sUyOzthGa8EqMr8J5FK3luYUUV77jtYl+u0cRAlmjESDMlxJPR+SxNTkfyGUMFy/YQzWZ/g+sBPOZMMoW74Gx1qt6DzWRRnnCA/aRrG9tFH6yGU3wkoibOMdepa15UMRKc1yjyJ34Ae6hECXFgcYEAAAAASUVORK5CYII=" />
    </a>
    <span>Letters are not case sensitive</span>
    <script type="text/javascript">
        function binara_reloadImage() {
            document.getElementById('binaraCAPTCHA').src = '../web/image.php?seed=' + Math.random();
        }
    </script>
</div>