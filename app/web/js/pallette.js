function napraviPaletu () {


    var sideBar = document.getElementsByTagName('aside');

        canvas = new fabric.Canvas('pallette',
            {
                backgroundColor: '#984B43',
                interactive: true,
                selection: false
            });
        canvas.setWidth(sideBar[0].clientWidth);
        canvas.setHeight(sideBar[0].clientHeight);

        return canvas;
}

    /*canvas.setBackgroundImage('../images/floor1.jpg', canvas.renderAll.bind(canvas), {
        originX: 'left',
        originY: 'top',

    });*/

    /*fabric.Image.fromURL('../images/chair.png', function (img) {
        img.left = 200;
        img.top = 200;
        img.scale(0.1);
        canvas.add(img);

        fabric.Image.fromURL('../images/round-table.png', function (img) {
            img.offsetTop = 0;
            img.offsetLeft = 0;
            img.scale(0.2);
            canvas.add(img);


        });

        fabric.Image.fromURL('../images/small-table.png', function (img) {
            img.offsetTop = 500;
            img.offsetLeft = 500;
            img.left = 500;
            img.top = 500;
            img.scale(0.2);
            canvas.add(img);
        });

        fabric.Image.fromURL('../images/big-table.png', function (img) {
            img.offsetTop = 0;
            img.offsetLeft = 0;
            img.scale(0.15);
            canvas.add(img);


        });

        fabric.Image.fromURL('../images/plant.png', function (img) {
            img.offsetTop = 0;
            img.offsetLeft = 0;

            img.scale(0.5);
            canvas.add(img);
        });

    })*/
