<div id="divCAPTCHA" class="binaraCAPTCHA-html-helper-container">
    <style type="text/css">
        .binaraCAPTCHA-html-helper-container {
            display: block;
            width: 280px;
            border-radius: 6px;
            background-color: #ffc23f;
            font-family: sans-serif;
            font-size: 14px;
            padding: 6px;
        }

        .binaraCAPTCHA-html-helper-container img {
            margin: auto;
            border-radius: 4px;
        }

        .binaraCAPTCHA-html-helper-container div {
            background-color: #fff77f;
            border-radius: 4px;
            margin-top: 6px;
            padding: 4px;
        }

        .binaraCAPTCHA-html-helper-container div input {
            display: block;
            float: left;
            width: 150px;
            border: #ffc23f solid 1px;
        }

        .binaraCAPTCHA-html-helper-container span {
            color: #666666;
            font-size: 11px;
            margin: auto auto auto 2px;
        }

        .binaraCAPTCHA-html-helper-container div a {
            display: block;
            float: left;
            text-decoration: none; 
            margin: 4px 0px 2px 6px;
        }

        .binaraCAPTCHA-html-helper-container div a img {
            vertical-align: middle;
        }

        .binaraCAPTCHA-html-helper-container div a span {
            color: black;
            font-size: 12px;
        }

        .binaraCAPTCHA-html-helper-container div a:hover span {
            color: orangered;
        }

        .binaraCAPTCHA-html-helper-container div label {
            display: block;
            float: left;
            margin: auto auto auto 2px;
        }
    </style>
    <img src="../web/image.php" alt="binaraCAPTCHA" title="binaraCAPTCHA" id="binaraCAPTCHA" />
    <div>
        <label for="binaraCAPTCHATextInput">Enter the characters shown in the image</label>
        <input type="text" id="binaraCAPTCHATextInput" name="binaraCAPTCHATextInput" />
        <a href="javascript: binara_reloadImage();" title="Reload Image">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAN1wAADdcBQiibeAAAAAd0SU1FB90DAg4cCRro3/kAAAELSURBVDjLldO/LkRREAbwnxU2ItFIvIBItCIRkdjCC6DUeQHUW2vQSBRaf6LU2EREgU4hQUhovIFSwSaL1cxNTtjr3p3kNPN938x858whPyawgIouooJlvKAdp1pWPIiTEL3hEKvoTTh11PIKHIe4geEczlFwbrCE/gyYD+ACff9MuZFY+8ZaBlyhhdECmyuJ+D71/onLEve0iL3gfmUXPBZVd0sUyOzthGa8EqMr8J5FK3luYUUV77jtYl+u0cRAlmjESDMlxJPR+SxNTkfyGUMFy/YQzWZ/g+sBPOZMMoW74Gx1qt6DzWRRnnCA/aRrG9tFH6yGU3wkoibOMdepa15UMRKc1yjyJ34Ae6hECXFgcYEAAAAASUVORK5CYII=" />
            <span>Reload Image</span>
        </a>
        <br />
        <span>Letters are not case-sensitive</span>
    </div>
    <script type="text/javascript">
        function binara_reloadImage() {
            document.getElementById('binaraCAPTCHA').src = '../web/image.php?seed=' + Math.random();
        }
    </script>
</div>