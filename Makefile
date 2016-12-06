.PHONY: all clean

clean:
	rm -rf ./build
	mkdir build

all:
	make clean
	g++ -std=c++11 -o ./build/yatable main.cpp

