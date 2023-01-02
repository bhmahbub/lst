     <section class="d-flex justify-content-center align-items-center my-0 shadow" style="background: #59C1BD;">
         <div class="container my-4">

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center breaking-news" style="background: #057a8d; border: 2px solid #ffffcc;">
                    <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center py-2 px-1 news fw-bolder " style="background: #ffffcc;"><span class="d-flex align-items-center">&nbsp;সর্বশেষ সংবাদ</span></div>
                    <marquee class="news-scroll text-white" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"><span class="dot mx-4"></span>চলতি মাসে এ যাবৎ মোট নিষ্পত্তিকৃত মামলার সংখ্যা {{ en2bnNumber($disposal_current_month) }} <span class="dot mx-4"></span>চলতি মাসে এ যাবৎ মোট দায়েরকৃত মামলার সংখ্যা {{ en2bnNumber($filing_current_month) }}<span class="dot mx-4"></span>বিগত মাসে মোট নিষ্পত্তিকৃত মামলার সংখ্যা {{ en2bnNumber($disposal_last_month) }} <span class="dot mx-4"></span>বিগত মাসে মোট দায়েরকৃত মামলার সংখ্যা {{ en2bnNumber($filing_last_month) }} </marquee>

                </div>
            </div>
        </div>

         </div>
    </section>
