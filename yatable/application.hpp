#include <iostream>

using namespace std;

namespace yatable
{
    class Application
    {
        public:
            int
            run();
    };

    int
    Application::run()
    {
        cout << "Sample app run" << endl;

        return 0;
    }
}
