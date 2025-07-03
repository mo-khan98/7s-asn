import { useState, useEffect } from 'react';
import type { Shift } from '../types/Shift';
import type { Assignment } from '../types/Assignment';
import { shiftService } from '../services/shiftService';
import { Card, CardContent, CardHeader, CardTitle } from './ui/card';
import { Button } from './ui/button';

export function ShiftList() {
  const [shifts, setShifts] = useState<Shift[]>([]);
  const [assignments, setAssignments] = useState<Assignment[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    loadData();
  }, []);

  const loadData = async () => {
    try {
      const [shiftsData, assignmentsData] = await Promise.all([
        shiftService.getAllShifts(),
        shiftService.getAllAssignments(),
      ]);
      setShifts(shiftsData);
      setAssignments(assignmentsData);
    } catch (error) {
      console.error('Error loading data:', error);
    } finally {
      setLoading(false);
    }
  };

  const getAssignmentForShift = (shiftId: number) => {
    return assignments.find(a => a.shift_id === shiftId);
  };

  if (loading) {
    return <div>Loading shifts...</div>;
  }

  return (
    <Card>
      <CardHeader>
        <CardTitle>Shifts</CardTitle>
      </CardHeader>
      <CardContent>
        <div className="space-y-4">
          {shifts.map((shift) => {
            const assignment = getAssignmentForShift(shift.id);
            return (
              <Card key={shift.id} className="p-4">
                <div className="flex justify-between items-center">
                  <div>
                    <p className="font-medium">{new Date(shift.day).toLocaleDateString()}</p>
                    <p className="text-sm text-gray-600">
                      {shift.start_time} - {shift.end_time} ({shift.role})
                    </p>
                    {assignment && (
                      <p className="text-sm text-green-600">Assigned to: {assignment.staff_name}</p>
                    )}
                  </div>
                  <Button variant="outline" size="sm">
                    {assignment ? 'Reassign' : 'Assign'}
                  </Button>
                </div>
              </Card>
            );
          })}
        </div>
      </CardContent>
    </Card>
  );
} 