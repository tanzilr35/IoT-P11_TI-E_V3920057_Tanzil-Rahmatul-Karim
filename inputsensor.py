import MySQLdb
import time

database = MySQLdb.connect("localhost", "root", "", "suhu_lembab")
cursor = database.cursor()

sql2 = cursor.execute("select count(*) from set_poin")
data = cursor.fetchone()

jml = data[0]
w = 1

# Pilih Ruangan
print("=====Pilih Ruangan======")
while w < jml+1:
    z = str(w)
    sql = cursor.execute(
        "select ruangan from set_poin where id_ruangan ='"+z+"'")
    ruangan = cursor.fetchone()
    t = str(ruangan[0])
    print(w, t)
    w += 1
nama_ruangan = str(input("Masukkan Ruang : "))

# Pilih Sensor
print("=======Sensor======")
print("1.Kelembaban")
print("2.Suhu ")

sensor = int(input("Sensor Yang Dipilih :"))

lama_pengecekan = input("Jangka Waktu : ")
jumlah_pengecekan = input("Jumlah Pengecekan : ")

a = cursor.execute(
    "select * from set_poin where nama_ruangan like '%"+ruang+"%'")
b = cursor.fetchone()
ruangan = str(b)[0]


# sensor Kelembaban
if sensor == 1:
    pilih_tabel = 'kelembaban'
    nilai = 0
    # jps(jumlah pengecekan sensor)
    jps = int(jumlah_pengecekan)
    # wps(waktu pengecekan sensor)
    wps = int(lama_pengecekan)
    nilai_max = jps
    while nilai < nilai_max:
        ph = str(random.randint(18, 50))
        t_end = time.time() + 60 * wps
        v = 0
        tbl_ph = []

        while time.time() < t_end:
            print("-----")
            v += 1

        waktu = str(datetime.now())
        info_ph = id_ruang, waktu, kelembaban
        tbl_ph.append(info_ph)
        sq = "insert into "+pilih_tabel + \
            " (ruang,waktu,kelembaban) values (%s,%s,%s)"
        inpt = cursor.executemany(sq, tbl_ph)
        print("Data Pengecekan Berhasil", tbl_ph)

        nilai += 1


# Sensor Suhu
if sensor == 2:
    pilih_tabel = 'suhu'
    nilai = 0
    jps = int(jumlah_pengecekan)
    wps = int(lama_pengecekan)
    nilai_max = jps
    while nilai < nilai_max:
        ph = str(random.randint(10, 37))
        t_end = time.time() + 60 * wps
        v = 0
        tbl_ph = []

        while time.time() < t_end:
            print("-----")
            v += 1

        waktu = str(datetime.now())
        inp_ph = ruang, waktu, ph
        tbl_ph.append(inp_ph)
        sq = "insert into "+pilih_tabel + \
            " (ruang,waktu,suhu) values (%s,%s,%s)"
        inpt = cursor.executemany(sq, tbl_ph)
        print("Data Pengecekan Berhasil", tbl_ph)

        nilai += 1




database.commit()
database.close()
