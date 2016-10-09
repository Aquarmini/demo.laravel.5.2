# -*- coding: UTF-8 -*-
import os
import sys
import zipfile
import hashlib
import shutil
import compileall
import time

SERVER_DIR = r"E:\phpStudy\WWW\_Lmx\_Demo\laravel"
APP = r"demo.laravel"
APP_VERTION = r"1.0"
APP_TIME = time.strftime('%Y%m%d%H%M%S')
APP_NAME = r"laravel"

def build_gma_version(version, version_dir, include_static_files=False):
    # copy application files
    print("=========================  COPY app FILES  ===========================")
    os.mkdir('app')
    os.chdir('app')
    os.system(r'xcopy /s %s\app\*.php' % SERVER_DIR)
    os.chdir('..')
    print("=========================  COPY  application.common FILES  ===========================")
    os.mkdir('resources')
    os.chdir('resources')
    os.mkdir('views')
    os.chdir('views')
    os.system(r'xcopy /s %s\resources\views\*.php' % SERVER_DIR)
    os.chdir('..')
    os.mkdir('assets')
    os.chdir('assets')
    os.mkdir('app')
    os.chdir('app')
    os.system(r'xcopy /s %s\resources\assets\app\*.*' % SERVER_DIR)
    os.chdir('..')
    os.chdir('..')
    os.chdir('..')

def pack_version(version_dir, zip_file_name):
    os.chdir('..')
    zip_file = zipfile.ZipFile(zip_file_name, 'w', zipfile.ZIP_DEFLATED)
    for root, dirs, files in os.walk(version_dir):
        for file in files:
            file_path = '%s/%s' % (root, file)
            zip_file.write(file_path)
    zip_file.close()

    # remove temporary file
    shutil.rmtree(version_dir)

if __name__ == '__main__':
    version = APP_VERTION
    version_dir = APP_NAME
    version_dir_zip = APP + '_v%s' % version + '_t%s' % APP_TIME
    version_dir_path = os.path.abspath('./versions/%s' % version_dir)
    zip_file_name = '%s.zip' % version_dir_zip

    if os.path.exists(version_dir_path):
        print("ERROR: %s is exists!" % version_dir_path)
        exit(0)

    # create root dir
    # os.chdir('/')
    os.chdir('/phpStudy/WWW/zips')
    os.mkdir(version_dir)
    os.chdir(version_dir)

    # build version
    build_gma_version(version, version_dir_path, include_static_files=True)

    # zip file
    pack_version(version_dir, zip_file_name)
    print('OK')