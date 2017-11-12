import subprocess

subprocess.check_call("python submitted.py", stderr=subprocess.STDOUT, shell = True)