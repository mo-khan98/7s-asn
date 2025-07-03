import { useState } from 'react';
import { Tabs, TabsContent, TabsList, TabsTrigger } from './components/ui/tabs';
import { Card, CardHeader, CardTitle } from './components/ui/card';
import { StaffList } from './components/StaffList';
import { AddStaffForm } from './components/AddStaffForm';
import { ShiftList } from './components/ShiftList';
import { CreateShiftForm } from './components/CreateShiftForm';

function App() {
  const [staffRefreshKey, setStaffRefreshKey] = useState(0);
  const [shiftRefreshKey, setShiftRefreshKey] = useState(0);

  const handleStaffAdded = () => {
    setStaffRefreshKey(prev => prev + 1);
  };

  const handleShiftCreated = () => {
    setShiftRefreshKey(prev => prev + 1);
  };

  return (
    <div className="min-h-screen bg-gray-50 p-4">
      <div className="max-w-6xl mx-auto">
        <Card className="mb-6">
          <CardHeader>
            <CardTitle className="text-2xl">Restaurant Staff Scheduler</CardTitle>
          </CardHeader>
        </Card>

        <Tabs defaultValue="staff" className="space-y-6">
          <TabsList className="grid w-full grid-cols-2">
            <TabsTrigger value="staff">Staff Management</TabsTrigger>
            <TabsTrigger value="shifts">Shift Scheduling</TabsTrigger>
          </TabsList>

          <TabsContent value="staff" className="space-y-6">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <AddStaffForm onStaffAdded={handleStaffAdded} />
              <div key={staffRefreshKey}>
                <StaffList />
              </div>
            </div>
          </TabsContent>

          <TabsContent value="shifts" className="space-y-6">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <CreateShiftForm onShiftCreated={handleShiftCreated} />
              <div key={shiftRefreshKey}>
                <ShiftList />
              </div>
            </div>
          </TabsContent>
        </Tabs>
      </div>
    </div>
  );
}

export default App;