<html>
    <title>Serah Terima Berkas Permohonan</title>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
    <style type="text/css">
        @page{
            size:21cm 27cm;
        }
        .page_break { page-break-before: always; }
            
        html{
            background-color: black;
            margin: 10px;
            padding: 0;
            font-size:12px;
            font-family: "Arial, Helvetica, sans-serif";
        }
        .header{
            width:21cm;
            clear:both;
                
        } 
        .judul {
            font-size:13px;
            font-weight:bold;           
                
        }
        .text-bold{
            font-weight: bold;
        }
        .text-right{
            text-align: right;
        }
        .text-center{
            text-align:center;
        }
        .kiriBawah{
            font-style:italic;
            top:-100px;
        }
        .content{
            padding:10px;
            display:inline;
        }
        #tableBO{
            border-collapse: collapse;
            border: 1px solid #eee;
            width: 100%;
        }
         #tableBO th{
            padding : 5px;
            border: 1px solid #333;
            text-align: center;
        }
        #tableBO td{
            padding : 5px;
            border: 1px solid #333;
        }
    </style>
    <body>
        <div class="header">
            <img src="<?php echo e(url('public/images/cop_surat.png')); ?>">
        </div>
        <div style="padding:20px">
            <center class="judul">ROUTING SLIP DOKUMEN PERIZINAN/NON PERIZINAN <br/> DPMPTSP PROVINSI KEPULAUAN RIAU</center>
            <br/><br/>
            <div style="width:50%; float:left">
            <table>
                <tr>
                    <td valign="top">Tanggal Daftar</td>
                    <td valign="top">&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                    <td valign="top">
                        asdkjashdlasdhla<br/>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Izin</td>
                    <td valign="top">&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                    <td valign="top">
                        asdkjashdlasdhla<br/>
                        asdkjashdlasdhla<br/>
                        asdkjashdlasdhla<br/>

                    </td>
                </tr>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>&nbsp; : &nbsp;</td>
                    <td></td>
                </tr>
                <tr>
                   <td>Nama Pemohon</td>
                   <td>&nbsp; : &nbsp;</td>
                   <td></td>
               </tr>
               <tr>
                    <td>Email / Hp</td>
                    <td>&nbsp; : &nbsp;</td>
                    <td></td>
                </tr>
            </table>
            </div>
            <div style="width:50%; float:right">
                <div class="text-right">
                    <img src="data:image/png;base64, <?php echo e(base64_encode(QrCode::format('png')->size(100)->generate('afriandi'))); ?>" width=80px>
                    <img src="<?php echo e(url('public/images/kswp.jpg')); ?>" width="200px">
                    <br/>
                    <table class="text-right">
                        <tr>
                            <td>Nomor Bukti Penerimaan</td>
                            <td>&nbsp; : &nbsp;</td>
                            <td></td>
                        </tr>
                        <tr>
                           <td>Front Office</td>
                           <td>&nbsp; : &nbsp;</td>
                           <td></td>
                       </tr>
                    </table>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div style="padding:20px">
            <br/>
         <table id="tableBO">
             <thead>
                 <tr>
                     <th width="10">NO</th>
                     <th width="300px">URAIAN</th>
                     <th>NAMA/NOMOR</th>
                     <th>TGL</th>
                     <th>KET</th>
                     <th>PARAF</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>1</td>
                     <td>Pemeriksaan & validasi berkas</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                 </tr>
                 <tr>
                    <td>2</td>
                    <td>Pembuatan surat permohonan rekomendasi teknis</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Penandatanganan surat permohonan</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
               
                <tr>
                    <td>4</td>
                    <td>Nomor Surat Rekomendasi Teknis</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Pembuatan draf SK (legal drafting)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Telaah legal drafting SK</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Penandatanganan SK oleh Kadis</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
                <tr>
                    <td>8</td>
                    <td>Persetujuan dan penomoran SK</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Dokumentasi arsip SK izin/non izin</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
             </tbody>
         </table>
        </div>
    </body>
</html><?php /**PATH C:\xampp\htdocs\siJempol2020\resources\views/pdf/routingSlip.blade.php ENDPATH**/ ?>