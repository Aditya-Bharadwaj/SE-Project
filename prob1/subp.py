import subprocess

g_out = open("op2.txt", "w");
f_out = open("output.txt", "w");
subprocess.check_call("python3 submitted.py", stdout=f_out, stderr=g_out,  shell = True)