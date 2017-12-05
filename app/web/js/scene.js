
function napraviScenu(){
var content = document.getElementsByTagName('article');
    canvas = new fabric.Canvas('scene',
        {
            backgroundColor: '#984B43',
            interactive : true,
            enableRetinacaling : true,
            selection : true,
            selectionBorderColor : "rgb(255,0,0)",
            skipOffscreen: true,
            targetFindTolerance: 3,

        });
    canvas.setWidth(content[0].clientWidth);
    canvas.setHeight(content[0].clientHeight);
    canvas.setBackgroundImage('../images/floor1.jpg', canvas.renderAll.bind(canvas), {
        originX: 'left',
        originY: 'top'

    });
    for(var i=0;i<26;i++) {
        if(i % 4 == 0) {
            fabric.Image.fromURL('../images/chair.png', function (img) {
                img.left = 200;
                img.top = 200;


                img.scale(0.1);
                canvas.add(img);

            });
        }
        if(i % 4 == 1) {
            fabric.Image.fromURL('../images/chair.png', function (img) {
                img.left = 200;
                img.top = 200;
                img.angle = 180;

                img.scale(0.1);
                canvas.add(img);

            });
        }
        if(i % 4 == 2) {
            fabric.Image.fromURL('../images/chair.png', function (img) {
                img.left = 200;
                img.top = 200;
                img.angle = 90;

                img.scale(0.1);
                canvas.add(img);

            });
        }
        if(i % 4 == 3) {
            fabric.Image.fromURL('../images/chair.png', function (img) {
                img.left = 200;
                img.top = 200;
                img.angle = 270;

                img.scale(0.1);
                canvas.add(img);

            });
        }
    }

    fabric.Image.fromURL('../images/round-table.png',function(img){
        img.offsetTop= 0;
        img.offsetLeft=0;

        img.scale(0.2);

        canvas.insertAt(img,0,true);


    });

    for(var j = 0 ; j < 4 ; j++) {
        fabric.Image.fromURL('../images/small-table.png', function (img) {
            img.offsetTop = 500;
            img.offsetLeft = 500;
            img.left = 500;
            img.top = 500;
            img.scale(0.2);
            img.animate('left', 500, {
                onChange: canvas.renderAll.bind(canvas),
                duration: 1000,
                easing: fabric.util.ease.easeOutBounce
            });
            canvas.add(img);


        });
    }
    fabric.Image.fromURL('../images/big-table.png',function(img){
        img.offsetTop= 0;
        img.offsetLeft=0;

        img.scale(0.15);
        canvas.add(img);


    });
    for(var i=0;i<4;i++) {
        fabric.Image.fromURL('../images/plant.png', function (img) {
            img.offsetTop = 0;
            img.offsetLeft = 0;

            img.scale(0.5);
            canvas.add(img);


        });
    }

    console.log(JSON.stringify(canvas.toJSON()));
    return canvas;
}